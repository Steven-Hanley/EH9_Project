package com.eh9.eh9project.retrofit.services

import retrofit2.Call
import retrofit2.http.GET
import com.eh9.eh9project.retrofit.models.Account

/**
 * get the accounts and put them into a list
 */
interface AccountService {
    @GET("accounts")
    fun getAllAccounts () : Call<List<Account>>
}