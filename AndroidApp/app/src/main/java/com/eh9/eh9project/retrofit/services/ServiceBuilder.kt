package com.eh9.eh9project.retrofit.services

import okhttp3.OkHttpClient
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

object ServiceBuilder {
    private val URL = "https://***REMOVED***/***REMOVED***/Super_Duper_Password_Utility_Tool_9001/Web/"

    // http client creation
    private val okHttp = OkHttpClient.Builder()

    private val builder = Retrofit.Builder().baseUrl(URL)
        .addConverterFactory(GsonConverterFactory.create())
        .client(okHttp.build())

    // instance of retrofit
    private val retrofit = builder.build()

    fun <T> buildService(serviceType: Class<T>) : T {
        return retrofit.create(serviceType)
    }
}