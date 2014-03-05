package com.sportsnetworkm;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.widget.TabHost;
import android.widget.TabHost.TabSpec;

public class TabMenu extends TabActivity {
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		TabHost host = getTabHost();// on récupère la racine
		/**
		* pour que les onglets soient toujours visibles quel que soit le thème
		* courant
		*/
		host.getTabWidget().setBackgroundColor(Color.BLACK);
		/**
		* Onglet de l'activité 0
		*/
		TabSpec spec = host.newTabSpec("Activity0"); // tag de l'onglet
		spec.setIndicator("", getResources().getDrawable(R.drawable.sport_icon2)); // nom qui sera affiché sur l'onglet
		spec.setContent(new Intent(this, Homenext.class)); // activité à lancer lors de l'activation de l'onglet
		host.addTab(spec);// on ajoute l'onglet
		/**
		* Onglet de l'activité 1
		*/
		spec = host.newTabSpec("Activity1"); // tag de l'onglet
		spec.setIndicator("", getResources().getDrawable(R.drawable.search_icon2)); // nom qui sera affiché sur l'onglet
		spec.setContent(new Intent(this, Homenext.class)); // activité à lancer lors de l'activation de l'onglet
		host.addTab(spec);// on ajoute l'onglet
		/**
		* Onglet de l'activité 2
		*/
		spec = host.newTabSpec("Activity2"); // tag de l'onglet
		spec.setIndicator("", getResources().getDrawable(R.drawable.favori_icon)); // nom qui sera affiché sur l'onglet
		spec.setContent(new Intent(this, Homenext.class)); // activité à lancer lors de l'activation de l'onglet
		host.addTab(spec);// on ajoute l'onglet
		/**
		* Onglet de l'activité 3
		*/
		spec = host.newTabSpec("Activity3"); // tag de l'onglet
		spec.setIndicator("", getResources().getDrawable(R.drawable.team_icon3)); // nom qui sera affiché sur l'onglet
		spec.setContent(new Intent(this, Homenext.class)); // activité à lancer lors de l'activation de l'onglet
		host.addTab(spec);// on ajoute l'onglet
	}
}