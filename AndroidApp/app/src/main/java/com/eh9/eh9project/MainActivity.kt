package com.eh9.eh9project

import android.content.Context
import android.os.Bundle
import android.util.AttributeSet
import android.util.Log
import android.view.View
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.FragmentManager
import androidx.fragment.app.FragmentTransaction
import androidx.navigation.findNavController
import androidx.navigation.ui.AppBarConfiguration
import androidx.navigation.ui.setupActionBarWithNavController
import androidx.navigation.ui.setupWithNavController
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.google.android.material.bottomnavigation.BottomNavigationView
import java.lang.reflect.Method
import java.nio.charset.Charset


class MainActivity : AppCompatActivity() {

    lateinit var fragmentManager: FragmentManager                                          //fragment classes
    lateinit var fragmentTransaction: FragmentTransaction

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val navView: BottomNavigationView = findViewById(R.id.nav_view)

        val navController = findNavController(R.id.nav_host_fragment)
        // Passing each menu ID as a set of Ids because each
        // menu should be considered as top level destinations.
        // Please work or your mum gay
        val appBarConfiguration = AppBarConfiguration(setOf(
                R.id.navigation_home, R.id.navigation_account, R.id.navigation_settings))
        setupActionBarWithNavController(navController, appBarConfiguration)
        navView.setupWithNavController(navController)
        postVolley()
    }

    fun postVolley() {
        val queue = Volley.newRequestQueue(this)
        val url = "https://***REMOVED***/***REMOVED***/Super_Duper_Password_Utility_Tool_9001/main.php"

        val requestBody = "password={Password goes here}" //TODO: Implement check for user entered password
        val stringReq : StringRequest =
                object : StringRequest(Method.POST, url,
                        Response.Listener { response ->
                            // response
                            var strResp = response.toString()
                            Log.d("API Testing", strResp)
                            //API Response is received here
                            val passResults = findViewById<TextView>(R.id.passResults)
                            passResults.text = strResp
                            //TODO: Handle API Data and convert the response to a usable format in order to give advice and build radar graph
                        },
                        Response.ErrorListener { error ->
                            Log.d("API Testing", "error => $error")
                            //Any errors are recieved here if an error occurs chances are its cos of app permissions
                        }
                ){
                    override fun getBody(): ByteArray {
                        return requestBody.toByteArray(Charset.defaultCharset())
                        //This function sets the parameters and doesnt need to be edited
                    }
                }
        queue.add(stringReq)
    }
}
