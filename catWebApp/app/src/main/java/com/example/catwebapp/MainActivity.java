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

import org.json.JSONException;
import org.json.JSONObject;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    // Get the layout elements for the LogIn screen
    private EditText etUsername, etPassword;
    private String username,password;
    // Set the URL of the server to connect into the database. You may change this to your own server
    private final String URL = "http://10.0.0.26/practicas_catWeb/catWeb/android/login.php";

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

        // Set the layout elements into vars
        username = password = "";
        etUsername = findViewById(R.id.etUsername);
        etPassword = findViewById(R.id.etPassword);

    }

    public void login(View view) {
        // Get the username and password from the EditText fields as Strings
        username = etUsername.getText().toString().trim();
        password = etPassword.getText().toString().trim();

        // Check if the username and password are not empty
        if (!username.isEmpty() && !password.isEmpty()) {
            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, response -> {
                Log.d("LOGIN_RESPONSE", response);
                // Parse the JSON response
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");

                    // Check the status of the login, if the user is an admin, show a toast message and do not allow the user to log in
                    if (status.equals("success admin")) {
                        Toast.makeText(MainActivity.this, "No se puede iniciar como administrador en esta aplicación", Toast.LENGTH_LONG).show();
                    } else if (status.equals("success user")) {
                        String userId = jsonObject.getString("user_id");
                        String username = jsonObject.getString("username");

                        // Save the user's data in the UserSession class
                        UserSession.getInstance().setUser(userId, username);

                        // Show a toast message and start the MainDashboard activity
                        Toast.makeText(MainActivity.this, "Bienvenid@ " + username + "!", Toast.LENGTH_SHORT).show();

                        // Start the MainDashboard activity
                        Intent intent = new Intent(MainActivity.this, MainDashboard.class);
                        startActivity(intent);
                        finish();

                    // If the login fails, show a toast message
                    } else {
                        Toast.makeText(MainActivity.this, "Usuario o contraseña incorrectos", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    Toast.makeText(MainActivity.this, "Error al procesar la respuesta", Toast.LENGTH_SHORT).show();
                }
            }, error -> {
                Toast.makeText(MainActivity.this, "Error de red: " + error.toString().trim(), Toast.LENGTH_SHORT).show();
            }) {
                // Send the username and password to the server (PHP)
                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> data = new HashMap<>();
                    data.put("username", username);
                    data.put("password", password);
                    return data;
                }
            };

            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringRequest);

        } else {
            Toast.makeText(this, "Rellene todos los campos", Toast.LENGTH_SHORT).show();
        }
    }
}

