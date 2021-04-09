package com.eh9.eh9project

import android.graphics.Color
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.github.mikephil.charting.animation.Easing
import com.github.mikephil.charting.charts.RadarChart
import com.github.mikephil.charting.components.XAxis
import com.github.mikephil.charting.data.RadarData
import com.github.mikephil.charting.data.RadarDataSet
import com.github.mikephil.charting.data.RadarEntry
import com.github.mikephil.charting.formatter.IndexAxisValueFormatter
import java.util.ArrayList


@Suppress("UNREACHABLE_CODE")
class RadarFragment : Fragment(R.layout.fragment_radar) {


    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_radar, container, false)


        lateinit var xAxis: XAxis


        val chart: RadarChart = view?.findViewById(R.id.chart)!!

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
                score.add(RadarEntry(1F))             //length
                score.add(RadarEntry(5F))             //Capitals
                score.add(RadarEntry(3F))             //Consecutive
                score.add(RadarEntry(5F))             //Complexity
                score.add(RadarEntry(4F))             //Repeating
                score.add(RadarEntry(5F))             //Numbers
                score.add(RadarEntry(5F))             //Lowercase

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


}