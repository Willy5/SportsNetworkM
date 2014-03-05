package com.sportsnetworkm;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DBAdapter {
	DatabaseHelper DBHelper;
	Context context;
	SQLiteDatabase db;
	
	public static final String db_sport =
			"CREATE TABLE sport" +
			"(_id INTEGER PRIMARY KEY," +
			"name TEXT," +
			"nbPlayersMin INTEGER," +
			"nbPlayersMax INTEGER" +
			");";
	
	public static final String db_event =
			"CREATE TABLE event" +
			"(_id INTEGER PRIMARY KEY," +
			"name TEXT," +
			"beginDate TEXT," +
			"endDate TEXT," +
			"discr TEXT" +
			");";
	
	public DBAdapter(Context context)
	{
		this.context = context;
		DBHelper = new DatabaseHelper(context);
	}

	public class DatabaseHelper extends SQLiteOpenHelper
	{
		
		Context context;
						
		public DatabaseHelper(Context context) {
			super(context, "spnt.db", null, 1);
			this.context = context;
		}
		
		// ----------------- APPAREMENT POUR AUTORISER LES FOREIGN KEY --------------------
		@Override
		public void onOpen(SQLiteDatabase db) {
		    super.onOpen(db);
		    if (!db.isReadOnly()) {
		        // Enable foreign key constraints
		        db.execSQL("PRAGMA foreign_keys=ON;");
		    }
		    
		}
		//----------------------------------------------------------------------------------

		@Override
		public void onCreate(SQLiteDatabase db) {
			db.execSQL(db_sport);
		}

		@Override
		public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
			// TODO Auto-generated method stub
			
		}
	}
	
	public DBAdapter open() {
		db = DBHelper.getWritableDatabase();
		// Enable foreign key constraints
		if (!db.isReadOnly()) {
        	db.execSQL("PRAGMA foreign_keys = ON;");
        }
		return this;
	}
	
	public void close() {
		db.close();
	}

//-----------------------------SUPPRESSION-------------------------------

//-----------------------------INSERTION---------------------------------
	
	public long insererSport (int _id, String name, int nbPlayersMin, int nbPlayersMax) {
		ContentValues values = new ContentValues();
		values.put("_id", _id);
		values.put("name", name);
		values.put("nbPlayersMin", nbPlayersMin);
		values.put("nbPlayersMax", nbPlayersMax);
		return db.insert("sport", null, values);
	}

//-----------------------------RECUPERERATION----------------------------

	public Cursor recupererSport(){
		return db.query("sport", new String[]{
				"_id",
				"name",
				"nbPlayersMin",
				"nbPlayersMax"
		}, null, null, null, null, null);
	}

//-----------------------------MODIFICATION------------------------------

}