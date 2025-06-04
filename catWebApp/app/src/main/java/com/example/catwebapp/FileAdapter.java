package com.example.catwebapp;

import android.app.AlertDialog;
import android.app.DownloadManager;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Environment;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.ImageButton;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import java.util.List;

public class FileAdapter extends RecyclerView.Adapter<FileAdapter.FileViewHolder> {
    private final List<File> fileList;

    public FileAdapter(List<File> fileList) {
        this.fileList = fileList;
    }

    @NonNull
    @Override
    public FileViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_file, parent, false);
        return new FileViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull FileViewHolder holder, int position) {
        File file = fileList.get(position);
        holder.tvFileName.setText(file.getName());

        holder.btnDownload.setOnClickListener(v -> {
            Context context = v.getContext();
            View dialogView = LayoutInflater.from(context).inflate(R.layout.download_confirm_modal, null);
            TextView textView2 = dialogView.findViewById(R.id.textView2);
            textView2.setText("¿Deseas descargar \"" + file.getName() + "\"?");

            AlertDialog dialog = new AlertDialog.Builder(context)
                    .setView(dialogView)
                    .create();

            dialogView.findViewById(R.id.buttonDialogCancel).setOnClickListener(view -> dialog.dismiss());

            dialogView.findViewById(R.id.buttonDialogConfirm).setOnClickListener(view -> {
                dialog.dismiss();

                String url = "http://10.0.0.26/PASANTIA_w3CAN/catWeb/uploads/" + file.getRealName();
                Log.d("DownloadURL", url);

                DownloadManager.Request request = new DownloadManager.Request(Uri.parse(url));
                request.setTitle(file.getName());
                request.setDescription("Descargando archivo...");
                request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
                request.setDestinationInExternalPublicDir(Environment.DIRECTORY_DOWNLOADS, file.getName());

                DownloadManager manager = (DownloadManager) context.getSystemService(Context.DOWNLOAD_SERVICE);
                if (manager != null) {
                    manager.enqueue(request);
                }
            });

            dialog.show();

            Window window = dialog.getWindow();
            if (window != null) {
                window.setLayout(ViewGroup.LayoutParams.WRAP_CONTENT, ViewGroup.LayoutParams.WRAP_CONTENT);
                window.setBackgroundDrawableResource(android.R.color.transparent);
                window.setGravity(Gravity.CENTER);
            }
        });
    }

    @Override
    public int getItemCount() {
        return fileList.size();

    }

    public static class FileViewHolder extends RecyclerView.ViewHolder {
        TextView tvFileName;
        ImageButton btnDownload;
        ImageButton btnPreview;

        public FileViewHolder(@NonNull View itemView) {
            super(itemView);
            tvFileName = itemView.findViewById(R.id.tvFileName);
            btnDownload = itemView.findViewById(R.id.btnDownload);
            btnPreview = itemView.findViewById(R.id.btnPreview);
        }
    }
}
