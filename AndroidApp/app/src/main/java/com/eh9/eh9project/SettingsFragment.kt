package com.eh9.eh9project

import android.content.Context
import android.graphics.Color
import android.os.Bundle
import android.view.*
import android.view.View.inflate
import androidx.appcompat.app.AppCompatDelegate
import androidx.core.content.res.ColorStateListInflaterCompat.inflate
import androidx.core.content.res.ComplexColorCompat.inflate
import androidx.fragment.app.Fragment
import com.github.mikephil.charting.animation.Easing
import com.github.mikephil.charting.charts.RadarChart
import com.github.mikephil.charting.components.AxisBase
import com.github.mikephil.charting.components.Legend
import com.github.mikephil.charting.components.XAxis
import com.github.mikephil.charting.components.YAxis
import com.github.mikephil.charting.data.RadarData
import com.github.mikephil.charting.data.RadarDataSet
import com.github.mikephil.charting.data.RadarEntry
import com.github.mikephil.charting.formatter.IndexAxisValueFormatter
import com.github.mikephil.charting.formatter.ValueFormatter
import com.github.mikephil.charting.interfaces.datasets.IRadarDataSet
import java.util.ArrayList
import android.view.MenuItem

class SettingsFragment : Fragment(R.layout.fragment_settings) {

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        //Checks the apps current theme and sets the button group to show the theme as active (Steven)
        val themeButtons = getView()?.findViewById<com.google.android.material.button.MaterialButtonToggleGroup>(R.id.btg_theme)
        val preferences = activity?.getSharedPreferences("App_Settings", Context.MODE_PRIVATE)
        when (preferences?.getInt("theme", AppCompatDelegate.MODE_NIGHT_FOLLOW_SYSTEM)) {
            -1 -> themeButtons?.check(R.id.btnSystem)
            1 -> themeButtons?.check(R.id.btnLight)
            2 -> themeButtons?.check(R.id.btnDark)
        }

        //On Click Listener for button group when pressed checks what button is pressed and sets the theme to that button also runs the activity funtion to save theme (Steven)
        themeButtons?.addOnButtonCheckedListener { _, selectedBtnId, isChecked ->
            if (isChecked) {
                val theme = when (selectedBtnId) {
                    R.id.btnSystem -> AppCompatDelegate.MODE_NIGHT_FOLLOW_SYSTEM
                    R.id.btnDark -> AppCompatDelegate.MODE_NIGHT_YES
                    else -> AppCompatDelegate.MODE_NIGHT_NO
                }

                AppCompatDelegate.setDefaultNightMode(theme)
                (activity as MainActivity).saveTheme(theme)
            }
        }
    }
}


