package com.eh9.eh9project

import android.accounts.Account
import android.os.Bundle
import android.telecom.Call
import android.util.Log
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.navigation.findNavController
import androidx.navigation.ui.AppBarConfiguration
import androidx.navigation.ui.setupActionBarWithNavController
import androidx.navigation.ui.setupWithNavController
import androidx.recyclerview.widget.GridLayoutManager
import com.eh9.eh9project.retrofit.helpers.AccountAdapter
import com.eh9.eh9project.retrofit.services.AccountService
import com.eh9.eh9project.retrofit.services.ServiceBuilder
import com.google.android.material.bottomnavigation.BottomNavigationView
import retrofit2.Callback
import okhttp3.Response

class MainActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val navView: BottomNavigationView = findViewById(R.id.nav_view)

        val navController = findNavController(R.id.nav_host_fragment)
        // Passing each menu ID as a set of Ids because each
        // menu should be considered as top level destinations

        val appBarConfiguration = AppBarConfiguration(setOf(
                R.id.navigation_home, R.id.navigation_dashboard, R.id.navigation_notifications))
        setupActionBarWithNavController(navController, appBarConfiguration)
        navView.setupWithNavController(navController)

        loadAccounts()
    }

    private fun loadAccounts() {

        val destinationService = ServiceBuilder.buildService(
            AccountService::class.java
        )

        val requestCall = destinationService.getAllAccounts()

        // initiate a network call on a seperate thread

        requestCall.enqueue(object : Callback<List<Account>>{

            override fun onResponse(call: Call<List<Account>>, response: Response<List<Account>>) {
                Log.d("Response", "onResponse: ${response.body()}")
                if (response.isSuccessful){
                    val accountList  = response.body()!!
                    Log.d("Response", "accountlist size : ${accountList.size}")
                    account_recycler.apply {
                        setHasFixedSize(true)
                        layoutManager = GridLayoutManager(this@MainActivity,2)
                        adapter = AccountAdapter(response.body()!!)
                    }
                }else{
                    Toast.makeText(
                        this@MainActivity,
                        "Something went wrong ${response.message()}", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<List<Account>>, t: Throwable) {
                Toast.makeText(this@MainActivity, "Something went wrong $t", Toast.LENGTH_SHORT).show()
            }
        })
    }
}