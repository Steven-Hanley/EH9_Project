package com.eh9.eh9project.classes

data class ApiResults(
    var scores: PasswordScores? = null,
    var dict: DictionaryResults? = null,
    var usedBefore: Boolean? = null
)
