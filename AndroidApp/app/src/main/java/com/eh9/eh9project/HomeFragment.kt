package com.eh9.eh9project


import android.app.Activity
import android.content.Context
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.view.inputmethod.InputMethodManager
import android.widget.*
import androidx.fragment.app.Fragment
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.eh9.eh9project.classes.apiResults
import com.google.gson.Gson
import java.nio.charset.Charset


class HomeFragment : Fragment(R.layout.fragment_home) {

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        val submitButton = getView()?.findViewById<Button>(R.id.submitPassword)
        val passwordText = getView()?.findViewById<EditText>(R.id.passwordSubmission)
        submitButton?.setOnClickListener {
            val password = passwordText?.getText().toString()
            if(password == ""){
                Toast.makeText(context, "Please Enter Password", Toast.LENGTH_SHORT).show()
            }else{
                view?.let { activity?.hideKeyboard(it) }
                Toast.makeText(context, "Checking Password", Toast.LENGTH_SHORT).show()

                passwordText?.setText("")
                sendRequest(password)
            }

        }
    }

    private fun sendRequest(password: String){
        val queue = Volley.newRequestQueue(activity)
        val url = "https://***REMOVED***/***REMOVED***/Super_Duper_Password_Utility_Tool_9001/main.php"
        val requestBody = "password=$password&user_id=1" //TODO: Implement check for user id if logged in
        val stringReq : StringRequest =
            object : StringRequest(
                Method.POST, url,
                Response.Listener { response ->
                    // response
                    val results = Gson().fromJson(response.toString(), apiResults::class.java)
                    printResults(results)
                },
                Response.ErrorListener { error ->
                    Log.d("API Testing", "error => $error")
                }
            ){
                override fun getBody(): ByteArray {
                    return requestBody.toByteArray(Charset.defaultCharset())
                }
            }
        queue.add(stringReq)
    }

    fun printResults(results: apiResults){
        val passResultsHeader = getView()?.findViewById<TextView>(R.id.homeResultsHeader)
        passResultsHeader?.text = "Results"
        val passResults = getView()?.findViewById<TextView>(R.id.passResults)
        passResults?.text = ("SCORES: \nLength Score: " + results.scores?.lengthScore + " \nCapital Score: " + results.scores?.capitalScore + "\nLower Score: " +
                results.scores?.lowerScore + "\nNumeric Score: " + results.scores?.numericScore + "\nComplex Score: " + results.scores?.complexScore +
                "\nRepeating Score: " + results.scores?.repeatingScore + "\n Consecutive Score: " + results.scores?.consecutiveScore + "\n DICTIONARY CHECKS\nExact Password Match: "
                + results.dict?.exactMatch + "\nDictionary Words Found: " + results.dict?.wordsInDict + "\n Has password already been used: " + results.usedBefore)
    }

    private fun Context.hideKeyboard(view: View) {
        val inputMethodManager = getSystemService(Activity.INPUT_METHOD_SERVICE) as InputMethodManager
        inputMethodManager.hideSoftInputFromWindow(view.windowToken, 0)
    }
}