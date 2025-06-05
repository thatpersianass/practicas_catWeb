package com.example.catwebapp;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

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

public class FolderFragment extends Fragment {
    // Get the layout elements for the Folder screen
    private FolderAdapter adapter;
    private List<Folder> folderList;
    public FolderFragment() {}

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_folder, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        // Set the layout elements into vars
        RecyclerView recyclerFolders = view.findViewById(R.id.recyclerFolders);
        recyclerFolders.setLayoutManager(new LinearLayoutManager(getContext()));

        folderList = new ArrayList<>();
        adapter = new FolderAdapter(folderList);
        recyclerFolders.setAdapter(adapter);

        // Set the folder click listener
        adapter.setOnFolderClickListener(folder -> {
            int folderId = folder.getId();
            String folderName = folder.getName();

            // Send the folder data to the FilesFragment
            Bundle bundle = new Bundle();
            bundle.putInt("folder_id", folderId);
            bundle.putString("folder_name", folderName);

            FilesFragment fileFragment = new FilesFragment();
            fileFragment.setArguments(bundle);

            // Replace the fragment in the Dashboard screen. In other word, change the screen elements
            requireActivity().getSupportFragmentManager()
                    .beginTransaction()
                    .replace(R.id.frame_layout, fileFragment)
                    .addToBackStack(null)
                    .commit();
        });

        loadFolders();
    }
    // Pretty self explanatory isn't it?
    private void loadFolders() {
        // Set the URL of the server to connect into the database. You may change this to your own server
        String userId = UserSession.getInstance().getUserId();
        String URL = "http://10.0.0.26/PASANTIA_w3CAN/catWeb/android/get_folders.php?user_id=" + userId;

        RequestQueue queue = Volley.newRequestQueue(requireContext());

        // Send the request to the server (PHP)
        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, URL, null,
                response -> {
            // Parse the JSON response
                    folderList.clear();
                    for (int i = 0; i < response.length(); i++) {
                        try {
                            JSONObject obj = response.getJSONObject(i);
                            int id = obj.getInt("id");
                            String name = obj.getString("name");

                            // Add the folder to the list (RecyclerView)
                            folderList.add(new Folder(id, name));
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                    adapter.notifyDataSetChanged();
                },
                // If the request fails, show a toast message
                error -> {
                    error.printStackTrace();
                });

        queue.add(request);
    }
}
