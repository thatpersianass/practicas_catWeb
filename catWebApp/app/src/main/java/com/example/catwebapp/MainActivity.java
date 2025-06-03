package com.example.catwebapp;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    private EditText etUsername, etPassword;
    private String username,password;
    private final String URL = "http://10.0.0.26/PASANTIA_w3CAN/catWeb/android/login.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        username = password = "";
        etUsername = findViewById(R.id.etUsername);
        etPassword = findViewById(R.id.etPassword);

    }

    public void login(View view){
        username = etUsername.getText().toString().trim();
        password = etPassword.getText().toString().trim();
        if(!username.isEmpty() && !password.isEmpty()){
            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, response -> {
                Log.d("LOGIN_RESPONSE", response);

                switch (response) {
                    case "success admin": {
                        Toast.makeText(MainActivity.this, "No se puede iniciar como administrador en esta aplicación, visite la página web", Toast.LENGTH_LONG).show();
                        break;
                    }
                    case "success user":
                        Toast.makeText(MainActivity.this, "Bienvenid@ " + username + "!", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(MainActivity.this, MainDashboard.class);
                        intent.putExtra("username", username);
                        startActivity(intent);
                        finish();
                        break;

                    case "failure":
                        Toast.makeText(MainActivity.this, "Usuario o Contraseña Incorrectos", Toast.LENGTH_SHORT).show();
                        break;
                }
            }, error -> Toast.makeText(MainActivity.this, error.toString().trim(), Toast.LENGTH_SHORT).show()){
                @Override
                protected Map<String, String> getParams() {
                    Map<String,String> data = new HashMap<>();
                    data.put("username",username);
                    data.put("password",password);
                    return data;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringRequest);

        } else {
            Toast.makeText(this,"Rellene todos los campos", Toast.LENGTH_SHORT).show();

        }
    }
}

