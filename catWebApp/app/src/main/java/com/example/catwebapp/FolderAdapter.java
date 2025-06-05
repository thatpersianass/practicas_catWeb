package com.example.catwebapp;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class FolderAdapter extends RecyclerView.Adapter<FolderAdapter.FolderViewHolder> {
    // Get the layout elements for the Folder screen
    private final List<Folder> folderList;
    private OnFolderClickListener listener;
    // This interface is used to send the folder data to the FilesFragment
    public interface OnFolderClickListener {
        void onFolderClick(Folder folder);
    }
    // Set the folder click listener
    public void setOnFolderClickListener(OnFolderClickListener listener) {
        this.listener = listener;
    }

    public FolderAdapter(List<Folder> folderList) {
        this.folderList = folderList;
    }

    @NonNull
    @Override
    public FolderViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_folder, parent, false);
        return new FolderViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull FolderViewHolder holder, int position) {
        // Set the folder name
        Folder folder = folderList.get(position);
        holder.tvFolderName.setText(folder.getName());

        // Set the folder click listener
        holder.itemView.setOnClickListener(v -> {
            if (listener != null) {
                listener.onFolderClick(folder);
            }
        });
        // Set the animation for the folder item
        Animation animation = AnimationUtils.loadAnimation(holder.itemView.getContext(), R.anim.item_animation_fade_in);
        holder.itemView.startAnimation(animation);
    }

    // Pretty self explanatory isn't it?
    @Override
    public int getItemCount() {
        return folderList.size();
    }

    // Clear the animation when the view is detached from the window
    @Override
    public void onViewDetachedFromWindow(@NonNull FolderViewHolder holder) {
        super.onViewDetachedFromWindow(holder);
        holder.itemView.clearAnimation();
    }

    // Get the layout elements for the Folder screen
    public static class FolderViewHolder extends RecyclerView.ViewHolder {
        TextView tvFolderName;

        // Set the layout elements into vars
        public FolderViewHolder(@NonNull View itemView) {
            super(itemView);
            tvFolderName = itemView.findViewById(R.id.tvFolderName);
        }
    }
}
