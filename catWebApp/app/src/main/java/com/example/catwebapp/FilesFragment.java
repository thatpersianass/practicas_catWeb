package com.example.catwebapp;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import androidx.appcompat.widget.SearchView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.List;

public class FilesFragment extends Fragment {
    // Get the layout elements for the Files screen
    private FileAdapter adapter;
    private List<File> fileList;
    private RecyclerView recyclerFiles;
    private TextView tvEmpty;


    public FilesFragment() {}

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_files, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        // Set the layout elements into vars
        TextView tvTitle = view.findViewById(R.id.tvTitle);
        recyclerFiles = view.findViewById(R.id.recyclerFiles);
        recyclerFiles.setLayoutManager(new LinearLayoutManager(getContext()));
        String folderName = getArguments() != null ? getArguments().getString("folder_name") : "Archivos";
        tvEmpty = view.findViewById(R.id.tvEmpty);
        fileList = new ArrayList<>();
        adapter = new FileAdapter(fileList);
        recyclerFiles.setAdapter(adapter);

        // Set the folder name
        tvTitle.setText(folderName);
        int folderId = getArguments() != null ? getArguments().getInt("folder_id") : -1;
        if (folderId != -1) {
            loadFiles(folderId);
        }

        // Rules for the SearchBar on the FilesFragment
        SearchView searchView = view.findViewById(R.id.searchView);
        searchView.setIconifiedByDefault(false);
        searchView.clearFocus();
        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                adapter.getFilter().filter(newText);
                return true;
            }
        });
    }

    private void loadFiles(int folderId) {
        // Set the URL of the server to connect into the database. You may change this to your own server
        String URL = "http://10.0.0.26/practicas_catWeb/catWeb/android/get_files.php?folder_id=" + folderId;
        RequestQueue queue = Volley.newRequestQueue(requireContext());

        // Send the request to the server (PHP)
        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, URL, null,
                response -> {
                    // Parse the JSON response
                    fileList.clear();
                    for (int i = 0; i < response.length(); i++) {
                        try {
                            JSONObject obj = response.getJSONObject(i);
                            int id = obj.getInt("id");
                            String name = obj.getString("name");
                            String realName = obj.getString("real_name");
                            // Add the file to the list (RecyclerView)
                            fileList.add(new File(id, name, realName));
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                    adapter = new FileAdapter(fileList);
                    recyclerFiles.setAdapter(adapter);


                    if (fileList.isEmpty()) {
                        tvEmpty.setVisibility(View.VISIBLE);
                    } else {
                        tvEmpty.setVisibility(View.GONE);
                    }
                },
                error -> error.printStackTrace());

        queue.add(request);
    }
}
