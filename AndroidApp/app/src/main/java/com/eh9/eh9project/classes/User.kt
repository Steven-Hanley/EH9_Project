package com.eh9.eh9project.classes

class User(val id: Int, val uname: String, val passwd: String) {

    private var username: String
        get() = username

    private var password: String
        get() = password

    private var userId: Int
        get() = userId

    init {
        userId = id
        username = uname
        password = passwd
    }
}