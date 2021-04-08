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
/*
class SettingsFragment : Fragment(R.layout.fragment_settings) {

    private var MAX = 12f                       //max value
    private var  MIN = 1f                       //min value
    var NB_QUALITIES = 5                        //nb qualities for Radar Chart
    lateinit var chart: RadarChart
    lateinit var xAxis: XAxis
    lateinit var yAxis: YAxis

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        chart = view.findViewById(R.id.chart)!!

        //configure radar graph
        chart.setBackgroundColor(Color.rgb(60, 65, 82))
        chart.description.isEnabled = false
        chart.webLineWidth = 1f
        //useful to export graph
        chart.webColor = Color.WHITE
        chart.webLineWidth = 1f
        chart.webColorInner = Color.WHITE
        chart.webAlpha = 100

        setData()

        //animate the chart
        chart.animateXY(1000, 1000, Easing.EaseInOutQuad, Easing.EaseInOutQuad)

        //define axis
        xAxis  = chart.xAxis
        xAxis.textSize = 10f
        xAxis.yOffset = 0F
        xAxis.xOffset = 0F
        xAxis.valueFormatter = object : IndexAxisValueFormatter() {

            val qualities: Array<String> = arrayOf("Length", "Capitals", "Consecutive", "Complexity", "Repeating", "Numbers", "Lowercase")

            override fun getFormattedValue(value:Float, axis: AxisBase): String {
                return qualities[value.toInt() % qualities.size]
            }

        } as ValueFormatter?

        xAxis.textColor = Color.WHITE
        yAxis = chart.yAxis
        yAxis.setLabelCount(NB_QUALITIES, false)
        yAxis.textSize = 9f
        yAxis.axisMaximum = MIN
        yAxis.axisMaximum = MAX
        yAxis.setDrawLabels(false)

        //configure legend for radar graph
        val l = chart.legend
        l.textSize = 15f
        l.verticalAlignment = Legend.LegendVerticalAlignment.TOP
        l.horizontalAlignment = Legend.LegendHorizontalAlignment.CENTER
        l.orientation = Legend.LegendOrientation.HORIZONTAL
        l.setDrawInside(false)
        l.xEntrySpace = 7f
        l.yEntrySpace = 5f
        l.textColor = Color.WHITE
    }

/*
    override fun OnCreateOptionsMenu (menu: Menu) {
        inflater.inflate(R.menu.radargraph, menu)
        return super.onCreateOptionsMenu(menu)

    }
*/

    override fun onOptionsItemSelected(item: MenuItem): Boolean {

        when (item.itemId) {
            R.id.refreshValues -> {
                setData()
                chart.invalidate()
            }
            R.id.toggleValues -> {
                for (set in chart.data.dataSets)
                {
                    set.setDrawValues(!set.isDrawValuesEnabled)
                }
                chart.invalidate()
            }
        }
        return super.onOptionsItemSelected(item)
    }

     fun setData() {
        val employee1: ArrayList<RadarEntry> = ArrayList()

         val val1 = (Math.random()).toInt() * MAX +MIN
         employee1.add(RadarEntry(val1))






        //create radar data sets objects with these data
        val set1 = RadarDataSet(employee1, "Employee A")
        set1.color = Color.RED
        set1.fillColor = Color.RED
        set1.fillAlpha = 100
        set1.setDrawFilled(true)
        set1.lineWidth = 2f
        set1.setDrawHighlightIndicators(false)
        set1.isDrawHighlightCircleEnabled = true

        val sets: ArrayList<IRadarDataSet> = ArrayList()
        sets.add(set1)




        // create Radar Data object which will be added to radar chart
        val data = RadarData(sets)
        data.setValueTextSize(8f)
        data.setDrawValues(false)
        data.setValueTextColor(Color.WHITE)





        chart.data = data
        chart.invalidate()

    }



*/

    class SettingsFragment : Fragment(R.layout.fragment_settings) {

        lateinit var chart: RadarChart
        lateinit var xAxis: XAxis


        override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

            chart = view.findViewById(R.id.chart)!!

            //configure radar graph
            chart.setBackgroundColor(Color.rgb(60, 65, 82))
            chart.description.isEnabled = false
            chart.webLineWidth = 1f
            //useful to export graph
            chart.webColor = Color.WHITE
            chart.webLineWidth = 1f
            chart.webColorInner = Color.WHITE
            chart.webAlpha = 100



            //animate the chart
            chart.animateXY(1000, 1000, Easing.EaseInOutQuad, Easing.EaseInOutQuad)

            val score: ArrayList<RadarEntry> = ArrayList()
            score.add(RadarEntry(420F))             //length
            score.add(RadarEntry(450F))             //Capitals
            score.add(RadarEntry(588F))             //Consecutive
            score.add(RadarEntry(640F))             //Complexity
            score.add(RadarEntry(550F))             //Repeating
            score.add(RadarEntry(630F))             //Numbers
            score.add(RadarEntry(470F))             //Lowercase

            val radardata = RadarDataSet(score, "Password Score")
            radardata.color = Color.WHITE
            radardata.fillColor = Color.WHITE
            radardata.fillAlpha = 100
            radardata.setDrawFilled(true)
            radardata.lineWidth = 2f
            radardata.setDrawHighlightIndicators(false)
            radardata.isDrawHighlightCircleEnabled = true
            radardata.valueTextColor = Color.WHITE

            val newRadarData = RadarData()
            newRadarData.addDataSet(radardata)

            val qualities: Array<String> = arrayOf("Length", "Capitals", "Consecutive", "Complexity", "Repeating", "Numbers", "Lowercase")
            xAxis = chart.xAxis
            xAxis.valueFormatter = IndexAxisValueFormatter(qualities)
            chart.data = newRadarData

        }

    }



















//    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
//
//        //Checks the apps current theme and sets the button group to show the theme as active (Steven)
//        val themeButtons = getView()?.findViewById<com.google.android.material.button.MaterialButtonToggleGroup>(R.id.btg_theme)
//        val preferences = activity?.getSharedPreferences("App_Settings", Context.MODE_PRIVATE)
//        when(preferences?.getInt("theme", AppCompatDelegate.MODE_NIGHT_FOLLOW_SYSTEM)){
//            -1 -> themeButtons?.check(R.id.btnSystem)
//            1 -> themeButtons?.check(R.id.btnLight)
//            2 -> themeButtons?.check(R.id.btnDark)
//        }
//
//        //On Click Listener for button group when pressed checks what button is pressed and sets the theme to that button also runs the activity funtion to save theme (Steven)
//        themeButtons?.addOnButtonCheckedListener { _, selectedBtnId, isChecked ->
//            if (isChecked) {
//                val theme = when (selectedBtnId) {
//                    R.id.btnSystem -> AppCompatDelegate.MODE_NIGHT_FOLLOW_SYSTEM
//                    R.id.btnDark -> AppCompatDelegate.MODE_NIGHT_YES
//                    else -> AppCompatDelegate.MODE_NIGHT_NO
//                }
//
//                AppCompatDelegate.setDefaultNightMode(theme)
//                (activity as MainActivity).saveTheme(theme)
//            }
//        }
//    }


