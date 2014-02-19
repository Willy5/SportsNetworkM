package com.sportsnetworkm;

import android.util.Log;

public class LogPerso {
	
	public static <T> void Logd(String tag, T x)
	{
		Log.d(tag, "Info : "+String.valueOf(x));
	}
	
	public static <T> void Loge(String tag, T x)
	{
		Log.e(tag, "Erreur : "+String.valueOf(x));
	}
}
