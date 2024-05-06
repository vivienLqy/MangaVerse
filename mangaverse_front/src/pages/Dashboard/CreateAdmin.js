import React, { useEffect, useState, useCallback } from "react";
import axios from "axios";
import NavAdmin from "../../components/wrapper/NavAdmin";
import { useNavigate } from "react-router-dom";

const CreateAdmin = () => {
  const [name, setName] = useState("");
  const [prix, setPrix] = useState();
  const [picture, setPicture] = useState("");
  const [quantiter, setQuantiter] = useState();
  const [categorieId, setCategorieId] = useState(0);
  const [categories, setCategories] = useState([]);
  const [oeuvreId, setOeuvreId] = useState(0);
  const [oeuvres, setOeuvres] = useState([]);
  const [typeId, setTypeId] = useState(0);
  const [types, setTypes] = useState([]);

  useEffect(() => {
    axios.get('http://localhost:8000/api/categories')
      .then((res) => {
        setCategories(res.data);
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la récupération des catégories : ",
          error
        );
      });

    axios.get("http://localhost:8000/api/oeuvres", {
      headers: {
        Authorization: `bearer ${localStorage.getItem("token")}`,
      },
    })
      .then((res) => {
        setOeuvres(res.data);
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la récupération des oeuvres : ",
          error
        );
      });

    axios.get("http://localhost:8000/api/types", {
      headers: {
        Authorization: `bearer ${localStorage.getItem("token")}`,
      },
    })
      .then((res) => {
        setTypes(res.data);
      })
      .catch((error) => {
        console.error("Une erreur s'est produite lors de la récupération des types : ", error);
      });
  }, []);

  const navigate = useNavigate();
  const publicUrl = process.env.PUBLIC_URL;

  console.log(publicUrl);

  const handleSubmit = useCallback((e) => {
    e.preventDefault();

    const selectedCategoryId = parseInt(categorieId);
    const selectedCategory = categories.find(cat => cat.id === selectedCategoryId);
    const selectedOeuvreId = parseInt(oeuvreId);
    const selectedOeuvre = oeuvres.find(oeuvre => oeuvre.id === selectedOeuvreId);
    const selectTypeId = parseInt(typeId);
    const selectedType = types.find(type => type.id === selectTypeId);

    if (selectedCategory && selectedOeuvre && selectedType) {
      const categorieName = selectedCategory.name;
      const oeuvreName = selectedOeuvre.name;
      const typeName = selectedType.name;

      console.log(picture);

      axios.post(`http://localhost:8000/api/products`, {
        name: name,
        prix: prix,
        picture: picture,
        quantiter: quantiter,
        categorie: {
          name: categorieName
        },
        oeuvres: {
          name: oeuvreName
        },
        type: {
          name: typeName
        }
      })
        .then((res) => {
          console.log("Produit créé avec succès !");
          navigate("/dashboard"); // Redirection après création réussie
        })
        .catch((error) => {
          console.error(
            "Une erreur s'est produite lors de la création du produit : ",
            error
          );
        });
    } else {
      console.error("Veuillez sélectionner une catégorie et une œuvre");
    }
  }, [categorieId, categories, name, navigate, oeuvreId, oeuvres, picture, prix, quantiter, typeId, types]);

  const handleCancel = () => {
    navigate("/dashboard");
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
          <div className="bg-white bg-opacity-10 w-1/4 flex justify-center items-center my-20 text-white">
            <div className="w-full flex flex-col justify-center items-center my-10">
              <div className="p-2 w-full bg-blackOP30 my-1 text-center">
                <h2>Crée un nouveau produit</h2>
              </div>
              <form onSubmit={handleSubmit} className="text-center p-5">
                <div className="mb-4 bg-blackOP30 my-1 text-center">
                  <select value={categorieId} onChange={(e) => { setCategorieId(e.target.value) }} className="p-2 bg-transparent w-full text-white">
                    <option value="">Selectionnez une catégorie</option>
                    {categories.map((cat, index) => (
                      <option className="text-black" key={index} value={cat.id}>{cat.name}</option>
                    ))}
                  </select>
                </div>
                <div className="mb-4 bg-blackOP30 my-1 text-center">
                  <select value={oeuvreId} onChange={(e) => { setOeuvreId(e.target.value) }} className="p-2 bg-transparent w-full text-white">
                    <option value="">Selectionnez une œuvre</option>
                    {oeuvres.map((oeuvre, index) => (
                      <option className="text-black" key={index} value={oeuvre.id}>{oeuvre.name}</option>
                    ))}
                  </select>
                </div>
                <div className="mb-4 bg-blackOP30 my-1 text-center">
                  <select value={typeId} onChange={(e) => { setTypeId(e.target.value) }} className="p-2 bg-transparent w-full text-white">
                    <option value="">Selectionnez un type</option>
                    {types.map((type, index) => (
                      <option className="text-black" key={index} value={type.id}>{type.name}</option>
                    ))}
                  </select>
                </div>
                <div className="bg-blackOP30 mb-4 text-center">
                  <input
                    type="text"
                    name="name"
                    placeholder="Tome du manga"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    className="bg-transparent w-full p-2"
                  />
                </div>
                <div className="bg-blackOP30 mb-4 text-center">
                  <input
                    type="number"
                    name="prix"
                    placeholder="prix"
                    value={prix}
                    onChange={(e) => setPrix(parseFloat(e.target.value))}
                    className="bg-transparent w-full p-2"
                  />
                </div>
                <div className="bg-blackOP30 mb-4 text-center">
                  <input
                    type="file"
                    name="picture"
                    placeholder="Chemin image"
                    value={picture}
                    onChange={(e) => setPicture(e.target.value)}
                    className="bg-transparent w-full p-2"
                  />
                </div>
                <div className="bg-blackOP30 mb-4 text-center">
                  <input
                    type="number"
                    name="quantiter"
                    placeholder="Quantité disponible"
                    value={quantiter}
                    onChange={(e) => setQuantiter(parseInt(e.target.value))}
                    className="bg-transparent w-full p-2"
                  />
                </div>
                <div className="w-full flex justify-center gap-4 mt-5">
                  <button type="button" className=" bg-red-700 rounded-md px-10 py-2 " onClick={handleCancel}>Annuler</button>
                  <button type="submit" className=" bg-green-700 rounded-md px-10 py-2">Valider</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div >
    </section >
  );
};

export default CreateAdmin;
