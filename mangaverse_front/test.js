import React, { useState } from "react";
import { NavLink } from "react-router-dom";
import Logo from "../../assets/Logo.svg";

const FormLog = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");

  const currentUrl = window.location.pathname;

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch("http://localhost:8000/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email, password }),
      });
      if (!response.ok) {
        throw new Error("Authentication failed");
      }
      // Authentification réussie, rediriger l'utilisateur
      window.location.href = "/"; // Rediriger vers la page d'accueil par exemple
    } catch (error) {
      setError("Authentication failed. Please check your credentials.");
    }
  };

  if (currentUrl === "/connexion") {
    return (
      <section>
        <div className="flex flex-col items-center bg-blue-900 bg-opacity-80 p-28 ">
          <div className="">
            <img src={Logo} alt="logo" />
          </div>
          <h1 className=" text-red-600 font-bold text-xl p-4">Connexion</h1>
          {error && <p className="text-red-600">{error}</p>}
          <form onSubmit={handleSubmit}>
            <div className="">
              <input
                type="email"
                name=""
                id=""
                placeholder="email"
                className="p-2 rounded-lg text-center bg-orange-200"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
              />
            </div>
            <div className="">
              <input
                type="password"
                name=""
                id=""
                placeholder="password"
                className="p-2 my-4 rounded-lg  text-center bg-orange-200"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>
            <button type="submit" className=" p-2 bg-blue-400 rounded-xl">
              Se connecter
            </button>
          </form>
          <p className="text-blue-400 font-bold">
            Vous n'avez pas encore de compte ?
            <NavLink to="/register">
              <strong className="text-red-600">Inscrivez-vous</strong>
            </NavLink>
          </p>
        </div>
      </section>
    );
  }

  if (currentUrl === "/register") {
    return (
      <section>
        <div className="flex flex-col items-center bg-blue-900 bg-opacity-80 p-28 text-center">
          <div className="">
            <img src={Logo} alt="logo" />
          </div>
          <h1 className=" text-red-600 font-bold text-xl p-4">Inscription</h1>
          <div className="">
            <div>
              <input
                type="email"
                name=""
                id=""
                placeholder="email"
                className="p-2 rounded-lg text-center w-full bg-orange-200"
              />
            </div>
            <div className="flex gap-2 my-4">
              <div className="">
                <input
                  type="text"
                  name=""
                  id=""
                  placeholder="Nom"
                  className="p-2 rounded-lg text-center bg-orange-200"
                />
              </div>
              <div className="">
                <input
                  type="text"
                  name=""
                  id=""
                  placeholder="Prenom"
                  className="p-2 rounded-lg text-center bg-orange-200"
                />
              </div>
            </div>
            <div className="">
              <input
                type="password"
                name=""
                id=""
                placeholder="Mot de passe"
                className="p-2  rounded-lg  text-center w-full bg-orange-200"
              />
            </div>
            <div className="">
              <input
                type="password"
                name=""
                id=""
                placeholder="Confirmation du mot de passe"
                className="p-2 my-3  rounded-lg  text-center w-full bg-orange-200"
              />
            </div>
            <button type="submit" className=" p-2 bg-blue-400 rounded-xl">
              S'inscrire
            </button>
            <p className=" text-blue-400 font-bold">
              Déjà un compte ?
              <NavLink to="/connexion">
                <strong className="text-red-700">Connectez-vous</strong>
              </NavLink>
            </p>
          </div>
        </div>
      </section>
    );
  }
};

export default FormLog;
