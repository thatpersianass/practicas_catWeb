package com.example.catwebapp;

import android.app.AlertDialog;
import android.app.DownloadManager;
import android.content.Context;
import android.content.Intent;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;

import android.widget.Filter;
import android.widget.Filterable;
import android.net.Uri;
import android.os.Environment;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

public class FileAdapter extends RecyclerView.Adapter<FileAdapter.FileViewHolder> implements Filterable {
    private final List<File> fileList;
    private final List<File> fileListFull;
    public FileAdapter(List<File> fileList) {
        this.fileList = fileList;
        this.fileListFull = new ArrayList<>(fileList);
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

        holder.btnPreview.setOnClickListener(v -> {
            Context context = v.getContext();
            String url = "http://10.0.0.26/PASANTIA_w3CAN/catWeb/uploads/" + file.getRealName();

            if (file.getRealName().endsWith(".pdf")) {
                Intent intent = new Intent(Intent.ACTION_VIEW);
                intent.setDataAndType(Uri.parse(url), "application/pdf");
                intent.setFlags(Intent.FLAG_ACTIVITY_NO_HISTORY | Intent.FLAG_GRANT_READ_URI_PERMISSION);

                try {
                    context.startActivity(intent);
                } catch (Exception e) {
                    Toast.makeText(context, "No se encontró una aplicación para abrir PDFs", Toast.LENGTH_SHORT).show();
                }
            } else {
                View dialogView = LayoutInflater.from(context).inflate(R.layout.dialog_image_preview, null);
                ImageView imageView = dialogView.findViewById(R.id.imageViewPreview);

                Glide.with(context)
                        .load(url)
                        .into(imageView);

                AlertDialog dialog = new AlertDialog.Builder(context)
                        .setView(dialogView)
                        .setNegativeButton("Cerrar", (d, which) -> d.dismiss())
                        .create();

                dialog.show();

                Window window = dialog.getWindow();
                if (window != null) {
                    window.setLayout(ViewGroup.LayoutParams.WRAP_CONTENT, ViewGroup.LayoutParams.WRAP_CONTENT);
                }
            }
        });

        Animation animation = AnimationUtils.loadAnimation(holder.itemView.getContext(), R.anim.item_animation_fade_in);
        holder.itemView.startAnimation(animation);

    }

    @Override
    public int getItemCount() {
        return fileList.size();

    }

    @Override
    public void onViewDetachedFromWindow(@NonNull FileViewHolder holder) {
        super.onViewDetachedFromWindow(holder);
        holder.itemView.clearAnimation();
    }

        @Override
        public Filter getFilter() {
            return fileFilter;
        }

        private final Filter fileFilter = new Filter() {
            @Override
            protected FilterResults performFiltering(CharSequence constraint) {
                List<File> filteredList = new ArrayList<>();

                if (constraint == null || constraint.length() == 0) {
                    filteredList.addAll(fileListFull);
                } else {
                    String filterPattern = constraint.toString().toLowerCase().trim();

                    for (File item : fileListFull) {
                        if (item.getName().toLowerCase().contains(filterPattern)) {
                            filteredList.add(item);
                        }
                    }
                }

                FilterResults results = new FilterResults();
                results.values = filteredList;
                return results;
            }

            @Override
            protected void publishResults(CharSequence constraint, FilterResults results) {
                fileList.clear();
                fileList.addAll((List<File>) results.values);
                notifyDataSetChanged();
            }
        };

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
