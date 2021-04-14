package com.eh9.eh9project

import android.content.Context
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.app.AppCompatDelegate
import androidx.navigation.findNavController
import androidx.navigation.ui.AppBarConfiguration
import androidx.navigation.ui.setupActionBarWithNavController
import androidx.navigation.ui.setupWithNavController
import com.eh9.eh9project.classes.PasswordScores
import com.eh9.eh9project.classes.user
import com.google.android.material.bottomnavigation.BottomNavigationView

class MainActivity : AppCompatActivity() {

    //Default App user account & passscores has to be global to be accessed across fragments (Steven)
    var appUser = user(0, "", "")
    var passScores = PasswordScores(0,0,0,0,0,0,0)

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val navView: BottomNavigationView = findViewById(R.id.nav_view)
        val navController = findNavController(R.id.nav_host_fragment)
        val appBarConfiguration = AppBarConfiguration(setOf(
                R.id.navigation_home, R.id.navigation_account, R.id.navigation_settings))
        setupActionBarWithNavController(navController, appBarConfiguration)
        navView.setupWithNavController(navController)

        //Runs load theme function at first start up to set the users chosen theme (Steven)
        //Runs the load account function on app start up to check if user has logged in previously if they have restores that account (Steven)
        loadTheme()
        loadAccount()
    }

    //Saves Account details into shared preferences so they can be persistent (Steven)
    internal fun saveAccount(savedUser: user){
        val sharedPreferences = getSharedPreferences("App_Settings", Context.MODE_PRIVATE)
        val editor = sharedPreferences.edit()
        editor.apply{
            savedUser.user_id?.let { putInt("user_id", it) }
            putString("username", savedUser.username)
        }.apply()
    }

    //Loads the account that is saved in the current shared preferences and defines the account variable (Steven)
    private fun loadAccount(){
        val sharedPreferences = getSharedPreferences("App_Settings", Context.MODE_PRIVATE)
        val username = sharedPreferences.getString("username", "")
        val user_id = sharedPreferences.getInt("user_id", 0)
        appUser.user_id = user_id
        if (username != null) {
            appUser.username = username
        }
    }

    //Used to save the theme to shared preferences in order for theme setting to be persistent (Steven)
    internal fun saveTheme(theme: Int){
        val sharedPreferences = getSharedPreferences("App_Settings", Context.MODE_PRIVATE)
        val editor = sharedPreferences.edit()
        editor.apply{
            putInt("theme", theme)
        }.apply()
    }

    //Loads the theme mainly used on first start up to retrieve users chosen theme (Steven)
    private fun loadTheme(){
        val sharedPreferences = getSharedPreferences("App_Settings", Context.MODE_PRIVATE)
        val theme = sharedPreferences.getInt("theme", AppCompatDelegate.MODE_NIGHT_FOLLOW_SYSTEM)
        AppCompatDelegate.setDefaultNightMode(theme)
    }

}
