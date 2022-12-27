package com.test.cruzeclub.ui.dangky;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;

import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import com.test.cruzeclub.Cruze;
import com.test.cruzeclub.GlobalVar;
import com.test.cruzeclub.R;
import com.test.cruzeclub.databinding.FragmentDangkyBinding;
import com.test.cruzeclub.databinding.FragmentIntroBinding;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class DangkyFragment extends Fragment {
    private FragmentDangkyBinding binding;
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentDangkyBinding.inflate(inflater, container, false);
        View root = binding.getRoot();
        TextView txtInsertFullName = root.findViewById(R.id.txtInsertFullName);
        TextView txtInsertFBName = root.findViewById(R.id.txtInsertFBName);
        TextView txtInsertPhone = root.findViewById(R.id.txtInsertPhone);
        TextView txtInsertAddress = root.findViewById(R.id.txtInsertAddress);
        TextView txtInsertStamp = root.findViewById(R.id.txtInsertStamp);
        TextView txtInsertPlate = root.findViewById(R.id.txtInsertPlate);
        TextView txtInsertGender = root.findViewById(R.id.txtInsertFBName);

        AlertDialog alertDialog = new AlertDialog.Builder(root.getContext()).setCancelable(true).create();
        alertDialog.setTitle("Thông báo");



        Button btnDangKy = root.findViewById(R.id.btnDangKy);
        btnDangKy.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                GlobalVar.service.createTicket(new Cruze(txtInsertFullName.getText().toString(),txtInsertFBName.getText().toString(),txtInsertPhone.getText().toString(),txtInsertAddress.getText().toString(),txtInsertGender.getText().toString(),txtInsertStamp.getText().toString(),txtInsertPlate.getText().toString())).enqueue(new Callback<String>() {
                    @Override
                    public void onResponse(Call<String> call, Response<String> response) {
                        alertDialog.setTitle("Đăng ký thành công");
                        alertDialog.setMessage("Vui lòng đợi để đơn đăng ký của bạn được duyệt");
                        alertDialog.show();

                    }

                    @Override
                    public void onFailure(Call<String> call, Throwable t) {
                        alertDialog.setTitle("Thông báo");
                        alertDialog.setMessage("Có lỗi xảy ra");
                        alertDialog.show();
                    }
                });

            }
        });



        return root;
    }


}