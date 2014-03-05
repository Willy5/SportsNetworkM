package com.sportsnetworkm;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.LinearLayout;

public class Home extends Activity  implements OnClickListener{
	
	DBAdapter db;
	LinearLayout layoutFont;
	
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
        setContentView(R.layout.home);
        
        db = new DBAdapter(this);
        db.open();
        
        layoutFont = ((LinearLayout)this.findViewById(R.id.layoutFont));
		layoutFont.setOnClickListener(this);
        
	}

	@Override
	public void onClick(View v) {
		
		switch(v.getId())
		{
			case R.id.layoutFont:
				Intent intent = new Intent(this, TabLayoutActivity.class);
				this.startActivity(intent);
				this.finish();
		}
	}

}