import React, { useEffect, useState } from "react";
import { NavLink } from "react-router-dom";
import BurgerMenu from "../BurgerMenu";
import Login from "../../assets/login.svg";
import Search from "../../assets/search.svg";
import Shop from "../../assets/shop.svg";
import Logo from "../../assets/Logo.svg";
import Logout from "../../assets/logout.svg";
import axios from "axios";

const Navbar = () => {

  const [oeuvres, setOeuvres] = useState('');
  console.log(localStorage);
  const logout = () => {
    localStorage.removeItem('token');
    window.location.href = "/connexion";
  }

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/users", {
        headers: {
          Authorization: `bearer ${localStorage.getItem("token")}`,
        },
      })
      .then((res) => {
        setOeuvres(res.data);
        // setProduits(res.data["hydra:member"]);
        console.log(res);
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la récupération des produits : ",
          error
        );
      });
  }, []);

  return (
    <div>
      <nav className=" bg-nav w-full " id="ancre-up">
        <div className="flex justify-around h-full items-center text-white">
          <div className="">
            <NavLink to="/" className="flex items-center">
              <img className="w-16 h-16 ml-5 " src={Logo} alt="logo" />
              <p>MangasVerse</p>
            </NavLink>
          </div>
          <div className="w-96">
            <ul className="hidden sm:flex w-full justify-between">
              <NavLink to="/">
                <li className="bg-lavande p-5">Accueil</li>
              </NavLink>
              <NavLink to="/catalogue">
                <li className="bg-lavande p-5">Catalogue</li>
              </NavLink>
              <NavLink to="/contact">
                <li className="bg-lavande p-5">Contact</li>
              </NavLink>
            </ul>
          </div>
          <div className="hidden sm:flex w-32 justify-between size-6">
            <NavLink to="/" className="svg-container">
              <img src={Search} alt="loupe" />
            </NavLink>
            <NavLink to="/dashboard" className="svg-container">
              <img src={Shop} alt="boutique" />
            </NavLink>
            {
              localStorage.getItem('token') ?
              <>
                <NavLink onClick={logout} to="#" className="svg-container">
                  <img src={Login} alt="profil" />
                </NavLink>
                <NavLink onClick={logout} to="/connexion" className="svg-container">
                  <img src={Logout} alt="deconnexion" />
                </NavLink>
                </>
                :
                <NavLink to="/connexion" className="svg-container">
                  <img src={Login} alt="connexion" />
                </NavLink>
            }

          </div>
          <div className="hamburger sm:hidden">
            <BurgerMenu></BurgerMenu>
          </div>
        </div>
      </nav>
    </div>
  );
};

export default Navbar;
