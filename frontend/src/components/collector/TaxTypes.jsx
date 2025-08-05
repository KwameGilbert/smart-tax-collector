import React from 'react'
import TaxTypeList from './TaxTypesList'
import VerticalBarChart from './VerticalBarChart'

const TaxTypes = () => {
  return (
    <div className='bg-white p-6 rounded shadow md:flex-2 w-[100%]'>
      <TaxTypeList/>
      <VerticalBarChart/>
    </div>
  )
}

export default TaxTypes
