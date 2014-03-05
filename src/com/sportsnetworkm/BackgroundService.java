package com.sportsnetworkm;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.os.Bundle;
import android.util.Log;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

public class BackgroundService extends Activity{
	
	DBAdapter db;
	Spinner listeSports;
	
	ArrayList<Integer> returnedValueSportId = new ArrayList<Integer>();
	ArrayList<String> returnedValueSportName = new ArrayList<String>();
	ArrayList<Integer> returnedValueSportNbPlayersMin = new ArrayList<Integer>();
	ArrayList<Integer> returnedValueSportNbPlayersMax = new ArrayList<Integer>();
	
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
        setContentView(R.layout.home);
        
        
        db = new DBAdapter(this);
        db.open();
        
        listeSports = ((Spinner)this.findViewById(R.id.listeSports));
        
        getServerDataSports();
        Integer[] ValueSportId = returnedValueSportId.toArray(new Integer[returnedValueSportId.size()]);  
		String[] ValueSportName = returnedValueSportName.toArray(new String[returnedValueSportName.size()]); 
        Integer[] ValueSportNbPlayersMin = returnedValueSportNbPlayersMin.toArray(new Integer[returnedValueSportNbPlayersMin.size()]);  
        Integer[] ValueSportNbPlayersMax = returnedValueSportNbPlayersMax.toArray(new Integer[returnedValueSportNbPlayersMax.size()]);  
        int x = 0;
		while(x < ValueSportId.length)
    	{
    		db.insererSport(ValueSportId[x], ValueSportName[x], ValueSportNbPlayersMin[x], ValueSportNbPlayersMax[x]);
    		LogPerso.Logd("name : ", ValueSportName[x]);
    		x++;
    	}
		
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, ValueSportName);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        listeSports.setAdapter(adapter);
        
	}
	
	public static String strURL = "http://sportsnetwork.pcgena.fr/web/app_dev.php/api/sports.json";
	
	private void getServerDataSports() {
		InputStream is = null;
		String result = "";
 
		// CHOIX REQUETE :
		ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
 
		// CONNEXION :
		try 
		{
			HttpClient httpclient = new DefaultHttpClient();
			String paramString = URLEncodedUtils.format(nameValuePairs, "utf-8");
			strURL += "?" + paramString;
			HttpGet  httpget = new HttpGet (strURL);
			HttpResponse response = httpclient.execute(httpget);
			HttpEntity entity = response.getEntity();
			is = entity.getContent();
		}
		catch(Exception e)
		{
			Log.e("log_tag", "Error in http connection ",e);
		}
 
		// CONVERSION REQUETE EN STRING
		try {
			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				sb.append(line + "\n");
			}
			is.close();
			result=sb.toString();
		}catch(Exception e){
			Log.e("log_tag", "Error converting result ",e);
		}
 
		// AFFICHAGE RESULTAT
		try
		{
			JSONObject jsonObj = new JSONObject(result);
			JSONArray jArray = jsonObj.getJSONArray("sports");
			//JSONArray jArray = new JSONArray(result);
			for(int i=0;i<jArray.length();i++){
				JSONObject json_data = jArray.getJSONObject(i);
				// Résultats de la requête : json_data.getInt("ID_ville")
				//returnString += jArray.getJSONObject(i)+"\n";
				returnedValueSportId.add(json_data.getInt("id"));
				returnedValueSportName.add(json_data.getString("name"));
				returnedValueSportNbPlayersMin.add(json_data.getInt("nb_players_min"));
				returnedValueSportNbPlayersMax.add(json_data.getInt("nb_players_max"));
			}
		}
		catch(JSONException e)
		{
			LogPerso.Loge("log_tag", "Error parsing data:"+e.toString());
			LogPerso.Logd("Result", result);
		}
	}

}