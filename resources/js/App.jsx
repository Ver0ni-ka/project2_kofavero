import { useEffect, useState } from "react";
import '../css/loader.css';
import '../css/styles.css';

function Header() {
    return (
      <header>
        <style>
@import url('https://fonts.googleapis.com/css2?family=Quintessential&family=Tangerine:wght@400;700&display=swap');
</style>
        <div>
          Project 2
        </div>
      </header>
    );
  }
  
  function Footer() {
    return (
      <footer>
        <div>
          V. Kofanova, VeA, 2025
        </div>
      </footer>
    );
  }
  



// Homepage- loads data from API and displays top books 
function Homepage({ handleBuildingSelection }) {     
    const [topBuildings, setTopBuildings] = useState([]);
    const [isLoading, setIsLoading] = useState(null);
    const [error, setError] = useState(null);

    useEffect(function () {
         async function fetchTopBuildings() { 

          try { 
            setIsLoading(true);
            setError(null);
            const response = await fetch('http://localhost/data/get-top-buildings'); 
            if (!response.ok) {             
                throw new Error("Error while loading data. Please reload page!");         
            } 
            const data = await response.json(); 
            console.log('top buildings fetched', data); 
            setTopBuildings(data); 
            
        } catch (error) { 
            setError(error.message); 
            }  finally { setIsLoading(false); } 
     } 
     fetchTopBuildings(); 
    }, []);

    return (         
    <>      
     {isLoading && <Loader />}    
     {error && <ErrorMessage msg={error} />} 
     {!isLoading && !error && ( 
        <div className="grid-container"> {
    topBuildings.map((building, index) => (                 
        
        <TopBuildingView                     
        building={building}                     
        key={building.id}                     
        index={index}                     
        handleBuildingSelection={handleBuildingSelection}/>             
    ))}</div> 
)  }     
    </>     
)} 



// Top Building View - displays buildings on Homepage
function TopBuildingView({ building, index, handleBuildingSelection }) {
    return (
      <div className="building-card">
        <img src={building.image} alt={building.name} />
        <div className="building-content">
          <p className="building-name">{building.name}</p>
          <p className="building-description">
            {(building.description.split(' ').slice(0, 16).join(' ')) + '...'}
          </p>
          <SeeMoreBtn 
                       buildingID={building.id} 
                       handleBuildingSelection={handleBuildingSelection} 
                  />
        </div>
      </div>
    );
  }

// See More Button 
function SeeMoreBtn({ buildingID, handleBuildingSelection }) { 
    return ( <button 
        className="seemorebutton" 
        onClick={() => handleBuildingSelection(buildingID)} 
        >See more</button> 
    ) } 


    // Main application component
    export default function App() {
        const [selectedBuildingID, setSelectedBuildingID] = useState(null);
    
        function handleBuildingSelection(buildingID) {
            setSelectedBuildingID(buildingID); // Set the selected building ID
        }
    
        function handleGoingBack() {
            setSelectedBuildingID(null); // Reset the selected building ID when going back
        }
    
        return (
            <>
                <Header />
                <main className="mt-12 mb-16 px-8 md:container md:mx-auto">
                    {selectedBuildingID ? (
                        <BuildingPage
                            selectedBuildingID={selectedBuildingID}
                            handleBuildingSelection={handleBuildingSelection}
                            handleGoingBack={handleGoingBack}
                        />
                    ) : (
                        <Homepage handleBuildingSelection={handleBuildingSelection} />
                    )}
                </main>
                <Footer />
            </>
        );
    }
    

// Building page component - structural component that contains parts of the building page
function BuildingPage({ selectedBuildingID, handleBuildingSelection, handleGoingBack }) {
    return (
        <>
            <SelectedBuildingView selectedBuildingID={selectedBuildingID} handleGoingBack={handleGoingBack} />
            <RelatedBuildingSection selectedBuildingID={selectedBuildingID} handleBuildingSelection={handleBuildingSelection} />
        </>
    )
}

// Selected Building View - displays selected building details
function SelectedBuildingView({ selectedBuildingID, handleGoingBack }) {
    const [selectedBuilding, setSelectedBuilding] = useState({});     
    const [isLoading, setIsLoading] = useState(false);     
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchSelectedBuilding() { 

         try { 
           setIsLoading(true);
           setError(null);
           const response = await fetch('http://localhost/data/get-building/' + selectedBuildingID); 
           if (!response.ok) {             
               throw new Error("Error while loading data. Please reload page!");         
           } 
           const data = await response.json(); 
           console.log('building' + selectedBuildingID + ' fetched', data); 
           setSelectedBuilding(data); 
           
       } catch (error) { 
           setError(error.message); 
           }  finally { setIsLoading(false); } 
    } 
    fetchSelectedBuilding(); 
   }, [selectedBuildingID]);


    return (
        <>
            {isLoading && <Loader />}    
            {error && <ErrorMessage msg={error} />} 
            {!isLoading && !error && <>  
            <div className="selected-building-container">
                <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                    <h1>
                        {selectedBuilding.name}
                    </h1>
                    <p>
                        {selectedBuilding.description}
                    </p>
                    <dl>
                        <dt>Built</dt>
                        <dd>{selectedBuilding.year}</dd>

                        <dt>Style</dt>
                        <dd>{selectedBuilding.style}</dd>

                        <dt>Architect</dt>
                        <dd>{selectedBuilding.architect}</dd>
                    </dl>
                </div>
                <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
                    <img
                        src={selectedBuilding.image}
                        alt={selectedBuilding.name}
                    />
                </div>
            </div>
            <div className="mb-12 flex flex-wrap">
                <GoBackBtn handleGoingBack={handleGoingBack} />
            </div>
        </>}
        </>
    )
}

// Go Back Button
function GoBackBtn({ handleGoingBack }) {
    return (
        <button
            className="goback"
            onClick={handleGoingBack}
        >
            Back
        </button>
    )
}

// Related Building Section
function RelatedBuildingSection({ selectedBuildingID, handleBuildingSelection }) {
    const [relatedBuildings, setRelatedBuildings] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchRelatedBuildings() {
            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch(
                    'http://localhost/data/get-related-buildings/' + selectedBuildingID
                );
                if (!response.ok) {
                    throw new Error("Error while loading related buildings. Please reload page!");
                }
                const data = await response.json();
                console.log('Related buildings fetched', data);
                setRelatedBuildings(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchRelatedBuildings();
    }, [selectedBuildingID]);

    return (
        <>
            <div className="flex flex-wrap">
                <h2 className="similar">
                    Similar buildings
                </h2>
            </div>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && (
                <div className="flex flex-wrap md:flex-row md:space-x-4 md:flex-nowrap">
                    {relatedBuildings.map((building) => (
                        <RelatedBuildingView
                            building={building}
                            key={building.id}
                            handleBuildingSelection={handleBuildingSelection}
                        />
                    ))}
                </div>
            )}
        </>
    );
}


// Related Building View
function RelatedBuildingView({ building, handleBuildingSelection }) {
    return (
        <div className="building-card rounded-lg mb-4 md:basis-1/3">
            <img
                src={building.image}
                alt={building.name}
                className="md:h-[400px] md:mx-auto max-md:w-2/4 max-md:mx-auto"/>
            <div className="building-content p-4">
                <h3 className="building-name">
                    {building.name}
                </h3>
                <SeeMoreBtn 
                buildingID={building.id} 
                handleBuildingSelection={handleBuildingSelection} />
            </div>
        </div>
    )
}



// Loader and Error Message components 
function Loader() {
    return ( 
    <div className="my-12 px-2 md:container md:mx-auto text-center clear-both"> 
    <div className="loader"></div> 
    </div> 
    ) } 
    
function ErrorMessage({ msg }) { return ( 
<div className="md:container md:mx-auto bg-red-300 my-8 p-2"> 
    <p className="text-black">{ msg }</p> </div> 
    ) } 
