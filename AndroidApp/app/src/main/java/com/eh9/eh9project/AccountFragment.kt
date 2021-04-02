package com.eh9.eh9project

import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.*
import androidx.fragment.app.Fragment
import at.favre.lib.crypto.bcrypt.BCrypt
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.eh9.eh9project.classes.user
import com.google.gson.Gson
import java.nio.charset.Charset

class AccountFragment : Fragment(R.layout.fragment_account) {
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        //When account page is loaded runs the check status function to determine what to show to the user (Steven)
        checkStatus((activity as MainActivity).appUser)

        //Adds listener for the login button ensures username and password are entered before sending the login request to the API (Steven)
        val loginButton = getView()?.findViewById<Button>(R.id.loginSubmit)
        loginButton?.setOnClickListener{
            val username = getView()?.findViewById<EditText>(R.id.usernameLogin)?.text.toString()
            val password = getView()?.findViewById<EditText>(R.id.passwordLogin)?.text.toString()
            when {
                username == "" -> {
                    Toast.makeText(context, "Please Enter Username", Toast.LENGTH_SHORT).show()
                }
                password == "" -> {
                    Toast.makeText(context, "Please Enter Password", Toast.LENGTH_SHORT).show()
                }
                else -> {
                    sendLogin(username)
                }
            }
        }

        //Logout button will reset global user info and resets the account page as well as removing the account data saved in settings (Steven)
        val logoutButton = getView()?.findViewById<Button>(R.id.logoutButton)
        logoutButton?.setOnClickListener{
            (activity as MainActivity).appUser.user_id = 0
            (activity as MainActivity).appUser.username = null
            checkStatus((activity as MainActivity).appUser)
            (activity as MainActivity).saveAccount((activity as MainActivity).appUser)
        }
    }

    //This function will determine what is shown on the account page based off user status (Steven)
    private fun checkStatus(savedUser: user){
        if (savedUser.user_id != 0){
            //Remove Login Fields
            val userField = view?.findViewById<EditText>(R.id.usernameLogin)
            userField?.visibility = View.GONE
            val passField = view?.findViewById<EditText>(R.id.passwordLogin)
            passField?.visibility = View.GONE
            val loginButton = view?.findViewById<Button>(R.id.loginSubmit)
            loginButton?.visibility = View.GONE

            //Add Logged In views
            val usernameText = view?.findViewById<TextView>(R.id.username)
            usernameText?.visibility = View.VISIBLE
            usernameText?.text = "Welcome ${savedUser.username}"
            val logoutButton = view?.findViewById<Button>(R.id.logoutButton)
            logoutButton?.visibility = View.VISIBLE
        }else{
            //Add Login Fields
            val userField = view?.findViewById<EditText>(R.id.usernameLogin)
            userField?.visibility = View.VISIBLE
            userField?.text = null
            val passField = view?.findViewById<EditText>(R.id.passwordLogin)
            passField?.visibility = View.VISIBLE
            passField?.text = null
            val loginButton = view?.findViewById<Button>(R.id.loginSubmit)
            loginButton?.visibility = View.VISIBLE

            //Remove Logged In views
            val usernameText = view?.findViewById<TextView>(R.id.username)
            usernameText?.visibility = View.GONE
            usernameText?.text = null
            val logoutButton = view?.findViewById<Button>(R.id.logoutButton)
            logoutButton?.visibility = View.GONE
        }
    }

    //This function will send the login username to the API and recieve the user info back. No password is sent from this. (Steven)
    private fun sendLogin(username: String){
        val queue = Volley.newRequestQueue(activity)
        val url = "https://***REMOVED***/***REMOVED***/Super_Duper_Password_Utility_Tool_9001/retrieveuser.php"
        val requestBody = "username=$username"
        val stringReq : StringRequest =
                object : StringRequest(
                        Method.POST, url,
                        Response.Listener { response ->
                            // response
                            val results = Gson().fromJson(response.toString(), user::class.java)
                            verifyUser(results)
                        },
                        Response.ErrorListener { error ->
                            Log.d("Login", "error => $error")
                        }
                ){
                    override fun getBody(): ByteArray {
                        return requestBody.toByteArray(Charset.defaultCharset())
                    }
                }

        queue.add(stringReq)
    }

    //This function will recieve the info from the API and firstly make sure its a real user before secondly checking to see if the account password matches the password the user sent if it is runs login protocol (Steven)
    fun verifyUser(results: user){
        if(results.user_id == null){
            Toast.makeText(context, "Invalid Login Details", Toast.LENGTH_SHORT).show()
        }else{
            val password = view?.findViewById<EditText>(R.id.passwordLogin)?.text.toString()

            if (BCrypt.verifyer().verify(password.toByteArray(), results.password?.toByteArray()).verified){
                results.password = null
                Toast.makeText(context, "Successfully Logged In", Toast.LENGTH_SHORT).show()
                (activity as MainActivity).appUser.user_id = results.user_id
                (activity as MainActivity).appUser.username = results.username
                (activity as MainActivity).saveAccount(results)
                checkStatus(results)
            }else{
                Toast.makeText(context, "Invalid Login Details", Toast.LENGTH_SHORT).show()
            }

        }
    }

}