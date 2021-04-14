package com.eh9.eh9project.classes

//User Class for Account Features Password isn't saved just needed to make the conversion for json work
data class user(
        var user_id: Int? = null,
        var username: String? = null,
        var password: String? = null
)
