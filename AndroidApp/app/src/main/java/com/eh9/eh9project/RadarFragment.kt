package com.eh9.eh9project

import android.graphics.Color
import android.os.Bundle
import android.util.Log
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

            var lengthScore : Float = (activity as MainActivity).passScores.lengthScore!!.toFloat()
            var capitalScore : Float = (activity as MainActivity).passScores.capitalScore!!.toFloat()
            var consecutiveScore : Float = (activity as MainActivity).passScores.consecutiveScore!!.toFloat()
            var complexityScore : Float = (activity as MainActivity).passScores.complexScore!!.toFloat()
            var repeatingScore : Float = (activity as MainActivity).passScores.repeatingScore!!.toFloat()
            var numberScore : Float = (activity as MainActivity).passScores.numericScore!!.toFloat()
            var lowerScore : Float = (activity as MainActivity).passScores.lowerScore!!.toFloat()

            var chart: RadarChart = view.findViewById(R.id.chart)!!

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
            score.add(RadarEntry(lengthScore))             //length
            score.add(RadarEntry(capitalScore))            //Capitals
            score.add(RadarEntry(consecutiveScore))        //Consecutive
            score.add(RadarEntry(complexityScore))         //Complexity
            score.add(RadarEntry(repeatingScore))          //Repeating
            score.add(RadarEntry(numberScore))             //Numbers
            score.add(RadarEntry(lowerScore))              //Lowercase

            val radarData = RadarDataSet(score, "Password Score")
            radarData.color = Color.WHITE
            radarData.fillColor = Color.WHITE
            radarData.fillAlpha = 100
            radarData.setDrawFilled(true)
            radarData.lineWidth = 2f
            radarData.setDrawHighlightIndicators(false)
            radarData.isDrawHighlightCircleEnabled = true
            radarData.valueTextColor = Color.WHITE

            val newRadarData = RadarData()
            newRadarData.addDataSet(radarData)

            val qualities: Array<String> = arrayOf("Length", "Capitals", "Consecutive", "Complexity", "Repeating", "Numbers", "Lowercase")
            var xAxis: XAxis = chart.xAxis
            xAxis.valueFormatter = IndexAxisValueFormatter(qualities)
            chart.yAxis.axisMaximum = 6F
            chart.data = newRadarData

        }
}


