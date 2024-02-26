import SearchBar from "./SearchBar";
import Category from "./Category";
import ToggleView from "./ToggleView";

function TopPanel() {
    return (
        <>
        <div className="top-panel">
            {/* Search Bar */}
            <SearchBar/>
            {/* Category */}
            <Category/>
            {/* Toggle View */}
            <ToggleView/>
        </div>
        </>
    );
}

export default TopPanel;