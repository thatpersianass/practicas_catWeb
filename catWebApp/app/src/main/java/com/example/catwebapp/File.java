package com.example.catwebapp;

public class File {
    private int id;
    private String name;

    public File(int id, String name) {
        this.id = id;
        this.name = name;
    }

    public int getId() { return id; }
    public String getName() { return name; }
}
