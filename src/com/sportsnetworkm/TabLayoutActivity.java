package com.sportsnetworkm;

import android.app.TabActivity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TabHost;
import android.widget.TabHost.TabSpec;
 
public class TabLayoutActivity extends TabActivity {
 
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.tablayoutactivity);
 
        TabHost tabHost = getTabHost();
 
        String label1 = "one";
        TabSpec spec1 = tabHost.newTabSpec(label1);
        spec1.setIndicator(label1);
        Intent intent1 = new Intent(this, Tab1Activity.class);
        spec1.setContent(intent1);
        tabHost.addTab(spec1);
 
        String label2 = "two";
        TabSpec spec2 = tabHost.newTabSpec(label2);
        spec2.setIndicator(label2);
        Intent intent2 = new Intent(this, Tab2Activity.class);
        spec2.setContent(intent2);
        tabHost.addTab(spec2);
 
    }
}