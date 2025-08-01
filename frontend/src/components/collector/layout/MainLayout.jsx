import React from 'react'
import { Outlet } from "react-router-dom";
import { useState } from 'react'
import FinanceMobileNavbar from './MobileNavbar';
import FinanceHeader from './Header';
import CollectorSidebar from './Sidebar';
import CollectorHeader from './Header';

const CollectorsMainLayout = () => {
  const [showLabels, setShowLabels] = useState(true);

  return (
    <div className='flex h-screen bg-gray-100 transition-transform duration-300 transform'>
      <CollectorSidebar showLabels={showLabels}/>

      <div className='flex flex-col flex-grow'>
        {/* mobile navigation */}
        <div className='md:hidden'>
          <FinanceMobileNavbar/>
        </div>

        <div className='flex-1 flex flex-col overflow-hidden'>
          {/* header */}
          <CollectorHeader setShowLabels={setShowLabels} showLabels={showLabels}/>

          <main className="flex-1 overflow-y-auto md:p-2 lg:p-4">
            {/* Main content */}
            <Outlet />
          </main>
        </div>
      </div>
    </div>
  )
}

export default CollectorsMainLayout
