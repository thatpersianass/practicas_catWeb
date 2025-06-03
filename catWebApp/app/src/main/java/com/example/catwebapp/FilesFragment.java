package com.example.catwebapp;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

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

    private FileAdapter adapter;
    private List<File> fileList;

    private TextView tvEmpty;


    public FilesFragment() {}

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_files, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        TextView tvTitle = view.findViewById(R.id.tvTitle);
        RecyclerView recyclerFiles = view.findViewById(R.id.recyclerFiles);
        recyclerFiles.setLayoutManager(new LinearLayoutManager(getContext()));
        String folderName = getArguments() != null ? getArguments().getString("folder_name") : "Archivos";
        tvEmpty = view.findViewById(R.id.tvEmpty);
        fileList = new ArrayList<>();
        adapter = new FileAdapter(fileList);
        recyclerFiles.setAdapter(adapter);

        tvTitle.setText(folderName);
        int folderId = getArguments() != null ? getArguments().getInt("folder_id") : -1;
        if (folderId != -1) {
            loadFiles(folderId);
        }
    }

    private void loadFiles(int folderId) {
        String URL = "http://10.0.0.26/PASANTIA_w3CAN/catWeb/android/get_files.php?folder_id=" + folderId;
        RequestQueue queue = Volley.newRequestQueue(requireContext());

        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, URL, null,
                response -> {
                    fileList.clear();
                    for (int i = 0; i < response.length(); i++) {
                        try {
                            JSONObject obj = response.getJSONObject(i);
                            int id = obj.getInt("id");
                            String name = obj.getString("name");

                            fileList.add(new File(id, name));
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                    adapter.notifyDataSetChanged();

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
