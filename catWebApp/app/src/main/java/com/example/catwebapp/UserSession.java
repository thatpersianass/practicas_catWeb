package com.example.catwebapp;

// This class is used to store the user data in a singleton object for the whole app
public class UserSession {
    // Singleton pattern for the UserSession class to store the user data
    private static UserSession instance;
    private String userId;
    private String username;

    private UserSession() {}

    public static synchronized UserSession getInstance() {
        if (instance == null) {
            instance = new UserSession();
        }
        return instance;
    }

    // Set the user data
    public void setUser(String userId, String username) {
        this.userId = userId;
        this.username = username;
    }

    // Get the user ID for the whole app
    public String getUserId() {
        return userId;
    }

    // Get the user Username for the whole app
    public String getUsername() {
        return username;
    }
}
