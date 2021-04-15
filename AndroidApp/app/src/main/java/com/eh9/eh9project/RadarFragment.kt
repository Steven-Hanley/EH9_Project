package com.eh9.eh9project

import android.graphics.Color
import android.os.Bundle
import android.util.Log
import android.view.MenuItem
import android.view.View
import androidx.fragment.app.Fragment
import com.github.mikephil.charting.animation.Easing
import com.github.mikephil.charting.charts.RadarChart
import com.github.mikephil.charting.components.XAxis
import com.github.mikephil.charting.data.RadarData
import com.github.mikephil.charting.data.RadarDataSet
import com.github.mikephil.charting.data.RadarEntry
import com.github.mikephil.charting.formatter.IndexAxisValueFormatter
import java.util.*


class RadarFragment : Fragment(R.layout.fragment_radar) {

        override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
            //Retrieves The scores from the main activity variable to be used for the graph (Steven)
            val lengthScore : Float = (activity as MainActivity).passScores.lengthScore!!.toFloat()
            val capitalScore : Float = (activity as MainActivity).passScores.capitalScore!!.toFloat()
            val consecutiveScore : Float = (activity as MainActivity).passScores.consecutiveScore!!.toFloat()
            val complexityScore : Float = (activity as MainActivity).passScores.complexScore!!.toFloat()
            val repeatingScore : Float = (activity as MainActivity).passScores.repeatingScore!!.toFloat()
            val numberScore : Float = (activity as MainActivity).passScores.numericScore!!.toFloat()
            val lowerScore : Float = (activity as MainActivity).passScores.lowerScore!!.toFloat()

            val chart: RadarChart = view.findViewById(R.id.chart)!!

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

            //Adds Scores to the chart
            val score: ArrayList<RadarEntry> = ArrayList()
            score.add(RadarEntry(lengthScore))             //length
            score.add(RadarEntry(capitalScore))            //Capitals
            score.add(RadarEntry(consecutiveScore))        //Consecutive
            score.add(RadarEntry(complexityScore))         //Complexity
            score.add(RadarEntry(repeatingScore))          //Repeating
            score.add(RadarEntry(numberScore))             //Numbers
            score.add(RadarEntry(lowerScore))              //Lowercase

            //Configures RadarChart settings
            val radarData = RadarDataSet(score, "Password Score")
            radarData.color = Color.WHITE
            radarData.fillColor = Color.WHITE
            radarData.fillAlpha = 100
            radarData.setDrawFilled(true)
            radarData.lineWidth = 2f
            radarData.valueTextSize = 12F
            radarData.setDrawHighlightIndicators(false)
            radarData.isDrawHighlightCircleEnabled = true
            radarData.valueTextColor = Color.WHITE

            val newRadarData = RadarData()
            newRadarData.addDataSet(radarData)

            val qualities: Array<String> = arrayOf("Length", "Capitals", "Consecutive", "Complexity", "Repeating", "Numbers", "Lowercase")
            chart.xAxis.valueFormatter = IndexAxisValueFormatter(qualities)
            chart.xAxis.textSize = 10F
            chart.xAxis.textColor = Color.WHITE
            chart.yAxis.textColor = Color.WHITE
            chart.yAxis.textSize = 10F
            chart.yAxis.mAxisMaximum = 5F
            chart.data = newRadarData
        }
}


