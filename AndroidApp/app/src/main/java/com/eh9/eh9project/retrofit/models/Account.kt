package com.eh9.eh9project.retrofit.models

import com.google.gson.annotations.SerializedName

data class Account (val userID: Int, val username: String, val password: String) {
    data class CountryInfo(
        val flag: String,
        @SerializedName("_id")
        val id: Int
    )
}