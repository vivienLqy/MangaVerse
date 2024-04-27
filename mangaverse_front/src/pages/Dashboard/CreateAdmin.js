import axios from "axios";
import React, { useEffect, useState } from "react";
import NavAdmin from "../../components/wrapper/NavAdmin";

const CreateAdmin = () => {
  const [name, setName] = useState("");
  const [prix, setPrix] = useState(0);
  const [picture, setPicture] = useState("");
  const [quantiter, setQuantiter] = useState("");
  const [created_at, setCreated_at] = useState(new Date());

  const handleValidation = () => {
    axios
      .post(`http://localhost:8000/api/products`, {
        name: name,
        prix: prix,
        picture: picture,
        quantiter: quantiter,
        created_at: created_at
      })
      .then((res) => {
        console.log("Produit crée avec succès !");
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la création du produit"
        );
      });
  };


  return (
    <section>
      <div className="w-full flex flex-row bg-bleuDark">
        <NavAdmin />
        <div className="w-full flex flex-col justify-center items-center">
          <div className="w-full h-96 bg-bgAdmin bg-no-repeat bg-cover bg-center">
            <h1 className="flex h-full justify-center items-center text-white">
              Produits
            </h1>
          </div>
          <form className=" text-center p-5">
            <div className="">
              <input
                type="text"
                name="name"
                placeholder="Tome du manga"
                onChange={(e) => setName(e.target.value)}
              />
            </div>
            <div className="my-2">
              <input
                type="value"
                name="prix"
                placeholder="prix"
                onChange={(e) => setPrix(parseFloat(e.target.value))}
              />
            </div>
            <div className="">
              <input
                type="text"
                name="picture"
                placeholder="Chemin image"
                onChange={(e) => setPicture(e.target.value)}
              />
            </div>
            <div className="my-2">
              <input
                type="number"
                name="quantiter"
                placeholder="Quantité disponible"
                onChange={(e) => setQuantiter(parseInt(e.target.value))}
              />
            </div>
            <div className="my-2">
              <input
                type="hidden"
                name="created_at"
                onChange={(e) => setCreated_at(new Date())}
              />
            </div>
            <button
              type="button"
              className=" bg-green-500 p-2 rounded-lg"
              onClick={handleValidation}
            >
              Creer
            </button>
          </form>
        </div>
      </div>
    </section>
  );
};

export default CreateAdmin;
