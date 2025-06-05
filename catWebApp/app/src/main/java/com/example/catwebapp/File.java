package com.example.catwebapp;

// This Class gets the files from the database and shows them in the FilesFragment
// Also it storages the file data to be used in any of the fragments
public class File {
    private int id;
    private String name;
    private String real_name;

    public File(int id, String name, String real_name) {
        this.id = id;
        this.name = name;
        this.real_name = real_name;
    }

    public int getId() { return id; }
    public String getName() { return name; }
    public String getRealName() { return real_name; }
}
