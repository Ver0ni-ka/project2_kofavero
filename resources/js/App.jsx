import { useEffect, useState } from "react";
import '../css/loader.css';

const topBuildings = [{"id":7,"name":"Panth\u00e9on","description":"The Panth\u00e9on in Paris was originally built as a church and later converted into a mausoleum, symbolizing neoclassical grandeur with its Corinthian columns and dome inspired by ancient Roman architecture","architect":"Maurice de Sully","style":"Classical","year":1753,"image":"http:\/\/localhost\/images\/6786b20827c10.jpg"},{"id":6,"name":"Notre-Dame Cathedral","description":"A famous Gothic cathedral located in Paris, known for its flying buttresses, stained glass windows, and spire","architect":"Maurice de Sully","style":"Gothic","year":1345,"image":"http:\/\/localhost\/images\/6786b00ce3231.jpg"},{"id":2,"name":"Eiffel Tower","description":"As France\u2019s symbol in the world, and the showcase of Paris, today it welcomes almost 7 million visitors a year (around 75% of whom are foreigners), making it the most visited monument that you have to pay for in the world.","architect":"Gustave Eiffel","style":"Industrial","year":1889,"image":"http:\/\/localhost\/images\/675b4583ae268.jpg"}]; 
    
const selectedBuilding = {"id":3,"name":"Palace of Versailles","description":"A royal ch\u00e2teau in France, originally a hunting lodge, expanded into a lavish palace for King Louis XIV, symbolizing absolute monarchy","architect":"Louis Le Vau","style":"Baroque","year":1682,"image":"http:\/\/localhost\/images\/6786ae89dfda4.jpg"}; 

//const relatedBuildings = [{"id":5,"name":"St. Basil's Cathedral","description":"A Russian Orthodox cathedral located in Moscow, known for its colorful onion domes and as a symbol of Russia\u2019s unique architectural heritage","architect":"Postnik Yakovlev","style":"Russian Orthodox","year":1561,"image":"http:\/\/localhost\/images\/6786ac4b8c62c.jpg"},{"id":4,"name":"Puente de Garabit","description":"A wrought-iron railway viaduct spanning the Truy\u00e8re River in central France. It features a grand parabolic arch, designed for both aesthetic appeal and structural efficiency, standing as one of the tallest bridges of its time","architect":"Gustave Eiffel","style":"Industrial","year":1884,"image":"http:\/\/localhost\/images"},{"id":6,"name":"Notre-Dame Cathedral","description":"A famous Gothic cathedral located in Paris, known for its flying buttresses, stained glass windows, and spire","architect":"Maurice de Sully","style":"Gothic","year":1345,"image":"http:\/\/localhost\/images\/6786b00ce3231.jpg"}]; 



function Header() 
{     
    return (         
    <header className="bg-green-500 mb-8 py-2 sticky top-0">            
    <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6 md:container md:mx-auto">                 
        Project 2             
        </div>         
        </header>     
        ) 
    }  
    function Footer() {
             return (
                         <footer className="bg-neutral-300 mt-8">
                                         <div className="py-8 md:container md:mx-auto px-2">                 
                                            V. Kofanova, VeA, 2025             
                                            </div>         
                                            </footer>     ) } 

                                            // Main application component



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
    topBuildings.map((building, index) => (                 
        
        <TopBuildingView                     
        building={building}                     
        key={building.id}                     
        index={index}                     
        handleBuildingSelection={handleBuildingSelection}/>             
    ))
)  }     
    </>     
)} 


// Top Building View - displays buildings on Homepage
function TopBuildingView({ building, index, handleBuildingSelection }) {
    return (
        <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
            <div className=
                {`order-2 px-12 md:basis-1/2 
                     ${ index % 2 === 1 ? "md:order-1 md:text-right" : ""}
                `}
            >
                <p className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                    {building.name}
                </p>
                <p className="mb-4 text-xl leading-7 font-light text-neutral-900 mb-4">
                    { (building.description.split(' ').slice(0, 16).join(' ')) + '...' }
                </p>
                <SeeMoreBtn 
                     buildingID={building.id} 
                     handleBuildingSelection={handleBuildingSelection} 
                />
            </div>
            <div className=
                {`order-1 md:basis-1/2 ${ index % 2 === 1 ? "md:order-2" : ""}`}
            >
                <img 
                     src={ building.image } 
                     alt={ building.name } 
                     className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto mx-auto" 
                />
            </div>
        </div>
    )
}

// See More Button 
function SeeMoreBtn({ buildingID, handleBuildingSelection }) { 
    return ( <button 
        className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bgsky-400 text-sky-50 cursor-pointer" 
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
                <main className="mb-8 px-2 md:container md:mx-auto">
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
            <div className="rounded-lg flex flex-wrap md:flex-row">
                <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                    <h1 className="text-3xl leading-8 font-light text-neutral-900 mb-2">
                        {selectedBuilding.name}
                    </h1>
                    <p className="text-xl leading-7 font-light text-neutral-900 mb-2">
                        {selectedBuilding.architect}
                    </p>
                    <p className="text-xl leading-7 font-light text-neutral-900 mb-4">
                        {selectedBuilding.description}
                    </p>
                    <dl className="mb-4 md:flex md:flex-wrap md:flex-row">
                        <dt className="font-bold md:basis-1/4">
                            Built
                        </dt>
                        <dd className="mb-2 md:basis-3/4">
                            {selectedBuilding.year}
                        </dd>

                        <dt className="font-bold md:basis-1/4">
                            Style
                        </dt>
                        <dd className="mb-2 md:basis-3/4">
                            {selectedBuilding.style}
                        </dd>

                        <dt className="font-bold md:basis-1/4">
                            Architect
                        </dt>
                        <dd className="mb-2 md:basis-3/4">
                            {selectedBuilding.architect}
                        </dd>
                    </dl>
                </div>
                <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
                    <img
                        src={selectedBuilding.image}
                        alt={selectedBuilding.name}
                        className="p-1 rounded-md border border-neutral-200 mx-auto"
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
            className="inline-block rounded-full py-2 px-4 bg-neutral-500 hover:bg-neutral-400 text-neutral-50 cursor-pointer"
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
                <h2 className="text-3xl leading-8 font-light text-neutral-900 mb-4">
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
        <div className="rounded-lg mb-4 md:basis-1/3">
            <img
                src={building.image}
                alt={building.name}
                className="md:h-[400px] md:mx-auto max-md:w-2/4 max-md:mx-auto"/>
            <div className="p-4">
                <h3 className="text-xl leading-7 font-light text-neutral-900 mb-4">
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
