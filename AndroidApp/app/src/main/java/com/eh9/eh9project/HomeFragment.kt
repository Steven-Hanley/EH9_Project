package com.eh9.eh9project

import android.app.Activity
import android.content.Context
import android.os.Bundle
import android.text.method.ScrollingMovementMethod
import android.util.Log
import android.view.View
import android.view.inputmethod.InputMethodManager
import android.widget.*
import androidx.fragment.app.Fragment
import androidx.fragment.app.FragmentTransaction
import androidx.navigation.fragment.findNavController
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.eh9.eh9project.classes.ApiResults
import com.google.gson.Gson
import java.nio.charset.Charset

class HomeFragment : Fragment(R.layout.fragment_home) {

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        //Allows the pass results to be scrollable in case results text is too big (Steven)
        val passResults = view.findViewById<TextView>(R.id.passResults)
        passResults?.movementMethod = ScrollingMovementMethod()

        //Sets the listener for analyse button and when clicked retrieves the text from pass field and sends it to the api removes the text and shows loading thing also lowers keyboard (Steven)
        val submitButton = getView()?.findViewById<Button>(R.id.submitPassword)
        val passwordText = getView()?.findViewById<EditText>(R.id.passwordSubmission)
        submitButton?.setOnClickListener {
            val password = passwordText?.text.toString()
            if (password == "") {
                Toast.makeText(context, "Please Enter Password", Toast.LENGTH_SHORT).show()
            } else {
                view.let { activity?.hideKeyboard(it) }
                val loading = view.findViewById<RelativeLayout>(R.id.loadingPanel)
                loading.visibility = View.VISIBLE
                passwordText?.setText("")
                sendRequest(password)
            }
        }
    }
	
    //This Function Sends the request to the API and retrieves the results after the results are received sends the function that prints the results the results of the generate advice function (Steven)
    private fun sendRequest(password: String){
        val queue = Volley.newRequestQueue(activity)
        val url = "https://***REMOVED***/~***REMOVED***/Super_Duper_Password_Utility_Tool_9001/main.php"
        val id = (activity as MainActivity).appUser.user_id
        val requestBody = "password=$password&user_id=$id"
        val stringReq : StringRequest =
            object : StringRequest(
                    Method.POST, url,
                    Response.Listener { response ->
                        // response
                        val results = Gson().fromJson(response.toString(), ApiResults::class.java)
                        printResults(generateAdvice(results))
                    },
                    Response.ErrorListener { error ->
                        Log.d("API Testing", "error => $error")
                        printResults("An Error Has Occurred")
                    }
            ){
                override fun getBody(): ByteArray {
                    return requestBody.toByteArray(Charset.defaultCharset())
                }
            }
        queue.add(stringReq)
    }

    //Generates the advice based on results received from the API and adds it all to string (Steven)  TODO:Make the Advice consisted across platfroms
    fun generateAdvice(results: ApiResults): String {
        //Sets Global Scores for access by radar graph fragment (Steven)
        (activity as MainActivity).passScores = results.scores!!

        //Begins Advice String and generates the advice (Steven)
        var advice = ""
        when (results.scores?.lengthScore){
            -1 -> advice += "• This password is too short.\n"
            1 -> advice += "• While this password is more than 8 characters it could still be longer.\n"
            2 -> advice += "• Password is a decent length but could still benefit from more characters.\n"
            4 -> advice += "• This password is a really strong length however passwords with over 20 characters are considered the optimal length.\n"
            6 -> advice += "• The password length of this password is very strong.\n"
        }

        when (results.scores?.capitalScore){
            -1 -> advice += "• This password doesn't contain any uppercase letters. Adding uppercase letters helps make passwords stronger\n"
            1 -> advice += "• This password only contains one uppercase letter consider adding more to increase security.\n"
            2 -> advice += "• While this password contains several uppercase letters it could benefit from adding more.\n"
            4 -> advice += "• This password contains a lot of uppercase letters however the optimal amount would be 6 or more.\n"
            6 -> advice += "• This password has the optimal amount of uppercase letters.\n"
        }

        when (results.scores?.lowerScore){
            -1 -> advice += "• This password contains very few lowercase letters. Adding lowercase letters helps make passwords stronger\n"
            1 -> advice += "• This password only contains few lowercase letters consider adding more to increase security.\n"
            2 -> advice += "• While this password contains several lowercase letters it could benefit from adding more.\n"
            4 -> advice += "• This password contains a lot of lowercase letters however the optimal amount would be 15 or more.\n"
            6 -> advice += "• This password has the optimal amount of lowercase letters.\n"
        }

        when (results.scores?.numericScore){
            -1 -> advice += "• This password doesn't contain any numbers. Adding numbers helps make passwords stronger\n"
            1 -> advice += "• This password only contains 3 numbers consider adding more to increase security.\n"
            2 -> advice += "• While this password contains several numbers it could benefit from adding more.\n"
            4 -> advice += "• This password contains a lot of numbers however the optimal amount would be 8 or more.\n"
            6 -> advice += "• This password has the optimal amount of numbers.\n"
        }

        when (results.scores?.complexScore){
            -1 -> advice += "• This password doesn't contain any symbol. Adding symbol helps make passwords stronger\n"
            1 -> advice += "• This password only contains one symbol consider adding more to increase security.\n"
            2 -> advice += "• While this password contains several symbols it could benefit from adding more.\n"
            4 -> advice += "• This password contains a lot of symbols however the optimal amount would be 4 or more.\n"
            6 -> advice += "• This password has the optimal amount of symbols.\n"
        }

        when (results.scores?.repeatingScore){
            -1 -> advice += "• This password contains a large amount of repeating characters this decreases password security.\n"
            1 -> advice += "• This password contains four repeating characters. This lowers overall password security.\n"
            2 -> advice += "• This password doesn't contain many repeating characters however could still do with losing a few.\n"
            4 -> advice += "• This password doesn't contain many repeating characters however the optimal amount would be 2 or less.\n"
            6 -> advice += "• This password has the optimal amount of repeating characters\n"
        }

        when (results.scores?.consecutiveScore){
            -1 -> advice += "• This password contains a lot of alphabetic patterns this can make your password very weak and vulnerable to certain algorithms.\n"
            1 -> advice += "• This password contains four alphabetic patterns. This lowers overall password security.\n"
            2 -> advice += "• This password doesn't contain many alphabetic patterns however could still do with losing a few.\n"
            4 -> advice += "• This password doesn't contain many alphabetic patterns however the optimal amount would be 2 or less.\n"
            6 -> advice += "• This password has the optimal amount of alphabetic patterns\n"
        }

        when (results.dict?.wordsInDict){
            true -> advice += "• This password contains actual words which can make it more vulnerable to guessing attacks\n"
            false -> advice += "• This password doesn't contain dictionary words making it less vulnerable.\n"
        }

        when (results.dict?.exactMatch){
            true -> advice += "• This password has been found in a common attack dictionary this makes it vulnerable to brute force attacks\n"
            false -> advice += "• This password has not been found in a common attack dictionary this makes it less likely to be brute forced.\n"
        }

        when (results.usedBefore){
            true -> advice += "• You have used this password before try and avoid repeating passwords to increase security across your accounts.\n"
            false -> advice += "• This password has not been used before.\n"
        }
        return advice
    }

    //Removes the loading circle and adds the results to the results field
    fun printResults(advice: String){
        val loading = view?.findViewById<RelativeLayout>(R.id.loadingPanel)
        loading?.visibility = View.GONE
        val passResultsHeader = view?.findViewById<TextView>(R.id.homeResultsHeader)
        passResultsHeader?.text = "Results"
        val passResults = view?.findViewById<TextView>(R.id.passResults)
        passResults?.movementMethod = ScrollingMovementMethod()
        passResults?.text = advice

        //Shows button to transfer to the radargraph fragment with the current scores
        val radarGraph = view?.findViewById<Button>(R.id.radarTransfer)
        radarGraph?.visibility = View.VISIBLE
        radarGraph?.setOnClickListener {
            findNavController().navigate(R.id.action_navigation_home_to_radarFragment)
        }

    }

    //Function for hiding keyboard (Steven)
    private fun Context.hideKeyboard(view: View) {
        val inputMethodManager = getSystemService(Activity.INPUT_METHOD_SERVICE) as InputMethodManager
        inputMethodManager.hideSoftInputFromWindow(view.windowToken, 0)
    }
}