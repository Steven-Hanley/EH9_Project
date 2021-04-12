package com.eh9.eh9project.classes

data class PasswordScores(
    var lengthScore: Int? = null,
    var capitalScore: Int? = null,
    var lowerScore: Int? = null,
    var numericScore: Int? = null,
    var complexScore: Int? = null,
    var repeatingScore: Int? = null,
    var consecutiveScore: Int? = null,
)
