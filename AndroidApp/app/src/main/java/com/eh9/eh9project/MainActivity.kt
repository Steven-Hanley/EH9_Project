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
import com.eh9.eh9project.classes.apiResults
import com.google.android.material.bottomnavigation.BottomNavigationView
import com.google.gson.Gson
import org.json.JSONObject
import java.lang.reflect.Method
import java.nio.charset.Charset


class MainActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val navView: BottomNavigationView = findViewById(R.id.nav_view)
        val navController = findNavController(R.id.nav_host_fragment)
        val appBarConfiguration = AppBarConfiguration(setOf(
                R.id.navigation_home, R.id.navigation_account, R.id.navigation_settings))
        setupActionBarWithNavController(navController, appBarConfiguration)
        navView.setupWithNavController(navController)

        //TODO Run the function that sends the data to the api with a button click and have it retrieve the data from the password field and send it.
        //TODO Build the radar graph with apiResults.passwordScores class and generate help advice for the user based off results
        //TODO Accounts Features for password history check
        //TODO Finish Design for the App
        //TODO Misc Settings for the app

        postVolley()
    }

    fun postVolley() {

        val queue = Volley.newRequestQueue(this)
        val url = "https://***REMOVED***/***REMOVED***/Super_Duper_Password_Utility_Tool_9001/main.php"

        val requestBody = "password=password&user_id=1" //TODO: Implement check for user entered password
        val stringReq : StringRequest =
                object : StringRequest(Method.POST, url,
                        Response.Listener { response ->
                            // response
                            val results = Gson().fromJson(response.toString(), apiResults::class.java)
                            printResults(results)
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

    fun printResults(results: apiResults){

        val passResults = findViewById<TextView>(R.id.passResults)
        passResults.text = ("SCORES: \nLength Score: " + results.scores?.lengthScore + " \nCapital Score: " + results.scores?.capitalScore + "\nLower Score: " +
                results.scores?.lowerScore + "\nNumeric Score: " + results.scores?.numericScore + "\nComplex Score: " + results.scores?.complexScore +
                "\nRepeating Score: " + results.scores?.repeatingScore + "\n Consecutive Score: " + results.scores?.consecutiveScore + "\n DICTIONARY CHECKS\nExact Password Match: "
                + results.dict?.exactMatch + "\nDictionary Words Found: " + results.dict?.wordsInDict + "\n Has password already been used: " + results.usedBefore)
    }
}
