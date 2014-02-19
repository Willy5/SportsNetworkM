package com.sportsnetworkm;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.os.Bundle;
import android.util.Log;
import android.widget.Spinner;

public class Home extends Activity{
	
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
	}
	
	public static final String strURL = "http://www.sportsnetwork.pcgena.fr/blabla/truc.json";
	
	private void getServerDataSports() {
		InputStream is = null;
		String result = "";
 
		// CHOIX REQUETE :
		ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
 
		// CONNEXION :
		try 
		{
			HttpClient httpclient = new DefaultHttpClient();
			HttpPost httpget = new HttpPost(strURL);
			httpget.setEntity(new UrlEncodedFormEntity(nameValuePairs));
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
			JSONArray jArray = new JSONArray(result);
			for(int i=0;i<jArray.length();i++){
				JSONObject json_data = jArray.getJSONObject(i);
				// Résultats de la requête : json_data.getInt("ID_ville")
				//returnString += jArray.getJSONObject(i)+"\n";
				returnedValueSportId.add(json_data.getInt("id"));
				returnedValueSportName.add(json_data.getString("name"));
				returnedValueSportNbPlayersMin.add(json_data.getInt("nbPlayersMin"));
				returnedValueSportNbPlayersMax.add(json_data.getInt("nbPlayersMax"));
			}
		}
		catch(JSONException e)
		{
			LogPerso.Loge("log_tag", "Error parsing data:"+e.toString());
			LogPerso.Logd("Result", result);
		}
	}

}