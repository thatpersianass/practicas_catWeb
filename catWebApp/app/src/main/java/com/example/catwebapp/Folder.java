package com.example.catwebapp;

// This Class gets the folders from the database and shows them in the FolderFragment
// Also it storages the folder data to be used in any of the fragments
public class Folder {
    private int id;
    private String name;

    public Folder(int id, String name) {
        this.id = id;
        this.name = name;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }
}
