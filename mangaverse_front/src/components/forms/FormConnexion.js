import React from 'react';
import Logo from "../../assets/Logo.svg";
import { NavLink } from 'react-router-dom';

const FormConnexion = () => {
    return (
        <div>
            <div className="flex flex-col items-center bg-blue-500 bg-opacity-70 p-28 ">
        <div className="">
          <img src={Logo} alt="logo" />
        </div>
        <h1 className=" text-red-600 font-bold text-xl p-4">Connexion</h1>
        <div className="text-center">
          <div className="">
            <input
              type="email"
              name=""
              id=""
              placeholder="email"
              className="p-2 rounded-lg text-center"
            />
          </div>
          <div className="">
            <input
              type="password"
              name=""
              id=""
              placeholder="password"
              className="p-2 my-4 rounded-lg  text-center"
            />
          </div>
          <button type="submit" className=" p-2 bg-blue-400 rounded-xl">
            se connecter
          </button>
          <p>
            Vous n'avez pas encore de compte ?
            <NavLink to="/register">
              <strong className="text-red-600">Inscrivez-vous</strong>
            </NavLink>
          </p>
        </div>
      </div>
        </div>
    );
};

export default FormConnexion;