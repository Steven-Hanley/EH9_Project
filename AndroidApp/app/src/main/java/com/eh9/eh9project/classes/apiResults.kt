package com.eh9.eh9project.classes

data class apiResults(
    var scores: passwordScores? = null,
    var dict: DictionaryResults? = null,
    var usedBefore: Boolean? = null
)
