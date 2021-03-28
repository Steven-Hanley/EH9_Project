package com.eh9.eh9project.retrofit.services

import retrofit2.Call
import retrofit2.http.GET
import com.eh9.eh9project.retrofit.models.Account

interface AccountService {
    @GET("accounts")
    fun getAllAccounts () : Call<List<Account>>
}