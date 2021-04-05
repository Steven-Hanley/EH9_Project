package com.eh9.eh9project

import android.graphics.Color
import android.graphics.Color.WHITE
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.Menu
import android.view.MenuItem
import com.github.mikephil.charting.charts.RadarChart
import com.github.mikephil.charting.data.RadarData
import com.github.mikephil.charting.data.RadarDataSet
import com.github.mikephil.charting.data.RadarEntry
import com.github.mikephil.charting.animation.Easing
import com.github.mikephil.charting.components.AxisBase
import com.github.mikephil.charting.components.Legend
import com.github.mikephil.charting.components.XAxis
import com.github.mikephil.charting.components.YAxis
import com.github.mikephil.charting.formatter.IndexAxisValueFormatter
import com.github.mikephil.charting.formatter.ValueFormatter
import com.github.mikephil.charting.interfaces.datasets.IRadarDataSet
import java.util.ArrayList




class RadarTest: AppCompatActivity() {

    private var MAX = 12f                       //max value
    private var  MIN = 1f                       //min value
    var NB_QUALITIES = 5                        //nb qualities for Radar Chart
    lateinit var chart: RadarChart
    lateinit var xAxis: XAxis
    lateinit var yAxis: YAxis

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.radarmain)
        chart = findViewById(R.id.chart)

        //configure radar graph
        chart.setBackgroundColor(Color.rgb(60, 65, 82))
        chart.description.isEnabled = false
        chart.webLineWidth = 1f
        //useful to export graph
        chart.webColor = WHITE
        chart.webLineWidth = 1f
        chart.webColorInner = WHITE
        chart.webAlpha = 100

        setData()

        //animate the chart
        chart.animateXY(1400, 1400, Easing.EaseInOutQuad)

        //define axis
        xAxis  = chart.xAxis
        xAxis.textSize = 10f
        xAxis.yOffset = 0F
        xAxis.xOffset = 0F
        xAxis.valueFormatter = object : IndexAxisValueFormatter() {

            val qualities: Array<String> = arrayOf("Length", "Capitals", "Consecutive", "Complexity", "Repeating", "Numbers", "Lowercase")

            override fun getFormattedValue(value:Float, axis:AxisBase): String {
                return qualities[value.toInt() % qualities.size]
            }

        } as ValueFormatter?
        xAxis.textColor = WHITE

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
        l.textColor = WHITE
    }



    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        menuInflater.inflate(R.menu.radargraph, menu)
        return super.onCreateOptionsMenu(menu)
    }

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

    private fun setData() {
        val employee1:ArrayList<RadarEntry> = ArrayList()
        val employee2:ArrayList<RadarEntry> = ArrayList()

        for (i in 0 .. NB_QUALITIES){
            val val1 = (Math.random()).toInt() * MAX +MIN
            employee1.add(RadarEntry(val1))

            val val2 = (Math.random()).toInt() * MAX +MIN
            employee2.add(RadarEntry(val2))
        }

        //create two radar data sets objects with these data
        val set1 = RadarDataSet(employee1, "Employee A")
        set1.color = Color.RED
        set1.fillColor = Color.RED
        set1.setDrawFilled(true)
        set1.lineWidth = 2f
        set1.setDrawHighlightIndicators(false)
        set1.isDrawHighlightCircleEnabled

        val set2 = RadarDataSet(employee1, "Employee B")
        set1.color = Color.RED
        set1.fillColor = Color.RED
        set1.setDrawFilled(true)
        set1.lineWidth = 2f
        set1.setDrawHighlightIndicators(false)
        set1.isDrawHighlightCircleEnabled

        val sets:ArrayList<IRadarDataSet> = ArrayList()
        sets.add(set1)
        sets.add(set2)

        // create Radar Data object which will be added to radar chart
        val data = RadarData(sets)
        data.setValueTextSize(8f)
        data.setDrawValues(false)
        data.setValueTextColor(WHITE)

        chart.data = data
        chart.invalidate()

    }


}


