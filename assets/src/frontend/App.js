import Pos from "./components/Pos";
import CartProvider from "./provider/CartProvider";

function App() {
   return (
      <CartProvider>
         <Pos/>
      </CartProvider>   
   );
}

export default App;

