package com.eh9.eh9project.retrofit.helpers

import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.eh9.eh9project.R
import com.eh9.eh9project.retrofit.models.Account

class AccountAdapter(private val accountList: List<Account>) : RecyclerView.Adapter<AccountAdapter.ViewHolder>() {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): AccountAdapter.ViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.account_item, parent, false)
        return ViewHolder(view)
    }

    override fun getItemCount(): Int {
        return accountList.size
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        Log.d("Response", "Account Count :${accountList.size}")

        return holder.bind(accountList[position])
    }

    class ViewHolder(itemView : View) :RecyclerView.ViewHolder(itemView) {

        var usernameTitle = itemView.findViewById<TextView>(R.id.usernameText)
        var passwordTitle = itemView.findViewById<TextView>(R.id.passwordText)
        var userIDTitle = itemView.findViewById<TextView>(R.id.userIDText)

        fun bind(account: Account) {
            usernameTitle.text = account.username
            passwordTitle.text = account.password
            userIDTitle.text = account.userID.toString()
        }

    }
}