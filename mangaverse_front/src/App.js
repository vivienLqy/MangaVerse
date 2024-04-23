import "./App.css";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Accueil from "./pages/Accueil";
import Wrapper from "./components/wrapper";
import Contact from "./pages/Contact";
import MonProduit from "./pages/MonProduit";
import Login from "./pages/Login";
import Dashboard from "./pages/Dashboard";
import Catalogue from "./pages/Catalogue";
import CreateAdmin from "./pages/CreateAdmin";
import UpdateOeuvre from "./pages/UpdateOeuvre";
import UpdateProduct from "./pages/UpdateProduct";


function App() {
  return (
    <BrowserRouter>
      <Wrapper>
        <Routes>
          <Route path="/" element={<Accueil />} />
          <Route path="/catalogue" element={<Catalogue />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/monproduit/:id" element={<MonProduit />}></Route>
          <Route path="/connexion" element={<Login />}></Route>
          <Route path="/register" element={<Login />}></Route>
          <Route path="/dashboard" element={<Dashboard />}></Route>
          <Route path="/dashboard/update/product/:id" element={<UpdateProduct />}></Route>
          <Route path="/dashboard/update/oeuvre/:id" element={<UpdateOeuvre />}></Route>
          <Route path="/dashboard/create/" element={<CreateAdmin />}></Route>

          <Route path="*" element={<Accueil />} />
        </Routes>
      </Wrapper>
    </BrowserRouter>
  );
}

export default App;
