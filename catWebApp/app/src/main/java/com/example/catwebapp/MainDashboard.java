package com.example.catwebapp;

import android.annotation.SuppressLint;
import android.app.Dialog;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.example.catwebapp.R;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import androidx.fragment.app.Fragment;

import com.example.catwebapp.databinding.DashboardMainBinding;

import java.util.Objects;

public class MainDashboard extends AppCompatActivity  {

    DashboardMainBinding binding;

    Dialog dialog;
    Button buttonDialogCancel, buttonDialogConfirm;

    @SuppressLint({"UseCompatLoadingForDrawables", "SetTextI18n"})
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = DashboardMainBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        replaceFragment(new FolderFragment());

        String username = UserSession.getInstance().getUsername();
        binding.tvWelcome.setText("Bienvenid@ " + username);

        dialog = new Dialog(MainDashboard.this);
        dialog.setContentView(R.layout.exit_confirmation_modal);
        Objects.requireNonNull(dialog.getWindow()).setLayout(ViewGroup.LayoutParams.WRAP_CONTENT,ViewGroup.LayoutParams.WRAP_CONTENT);
        dialog.getWindow().setBackgroundDrawable(getDrawable(R.drawable.glass_background));
        dialog.setCancelable(true);

        buttonDialogConfirm = dialog.findViewById(R.id.buttonDialogConfirm);
        buttonDialogCancel = dialog.findViewById(R.id.buttonDialogCancel);

        buttonDialogCancel.setOnClickListener(v -> dialog.dismiss());

        buttonDialogConfirm.setOnClickListener(v -> finishAffinity());

        binding.bottomNavigationView.setOnItemSelectedListener(item -> {

            int id = item.getItemId();

            if (id == R.id.homeBtn) {
                replaceFragment(new FolderFragment());
            } else if (id == R.id.filesBtn) {
                replaceFragment(new FilesFragment());
            } else if (id == R.id.exitBtn) {
                dialog.show();
            }

            return true;
        });
    }

    private void replaceFragment(Fragment fragment){
        FragmentManager fragmentManager = getSupportFragmentManager();
        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
        fragmentTransaction.replace(R.id.frame_layout,fragment);
        fragmentTransaction.commit();
    }
}
