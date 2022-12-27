package com.test.cruzeclub;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Path;

public interface CruzeHolderAPI {
    @GET("allplate")
    Call<List<Cruze>> getAllPlate();
    @GET("car_codes")
    Call<List<CarCode>> getCarCodes();
    @GET("agency/{mien}")
    Call<List<Mien>> getAgency(@Path(value = "mien", encoded = true) String mien);
    @GET("partner/{mien}")
    Call<List<Mien>> getPartner(@Path(value = "mien", encoded = true) String mien);
    @GET("info")
    Call<String> getInfo();
    @POST("create_ticket")
    Call<String> createTicket(@Body Cruze ticket);
    @GET("search/{plate}")
    Call<List<Cruze>> searchWithPlate(@Path(value = "plate", encoded = true) String plate);





}
