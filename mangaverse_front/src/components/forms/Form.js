import React from "react";
import Logo from "../../assets/Logo.svg";
import { useForm } from "react-hook-form";

const Form = () => {
  const { register, handleSubmit } = useForm();
  const onSubmit = (data) => console.log(data);

  return (
    <form onSubmit={handleSubmit(onSubmit)}>
      <div className="w-3/4 mx-auto bg-gray-700 rounded-lg ">
        <div className=" flex flex-col items-center">
          <img src={Logo} alt="" className="w-16 h-16 ml-5 mt-5" />
          <h2 className="text-2xl">Formulaire de contact</h2>
        </div>
        <div className="md:flex ">
          <div className="w-full p-4 flex flex-col justify-around">
            <div className="flex my-2">
              <div className=" w-1/2 pr-2">
                <input
                  type="name"
                  {...register("name")}
                  id="name"
                  name="name"
                  placeholder="Nom"
                  className=" py-3 text-center w-full bg-gray-800 rounded  text-gray-100  "
                />
              </div>
              <div className=" w-1/2 pl-2">
                <input
                  type="text"
                  {...register("prenom")}
                  id="prenom"
                  name="prenom"
                  placeholder="Prenom"
                  className=" py-3 text-center w-full bg-gray-800 rounded  text-gray-100 "
                />
              </div>
            </div>
            <div className="">
              <input
                type="email"
                {...register("email")}
                id="email"
                name="email"
                placeholder="Email"
                className=" py-3 text-center w-full bg-gray-800 rounded  text-gray-100 "
              />
            </div>
            <div className=" mt-4">
              <input
                type="tel"
                {...register("telephone")}
                id="telephone"
                name="telephone"
                placeholder="Telephone"
                className=" py-3 text-center w-full bg-gray-800 rounded  text-gray-100 "
              />
            </div>
            <div className=" mt-4">
              <input
                type="text"
                {...register("sujet")}
                id="sujet"
                name="sujet"
                placeholder="Sujet"
                className="  py-3 text-center w-full bg-gray-800 rounded  text-gray-100 "
              />
            </div>
          </div>
          <div className="w-full p-4">
            <div className="">
              <textarea
                id="message"
                {...register("message")}
                name="message"
                placeholder="Message"
                className=" text-center w-full bg-gray-800 rounded  h-64 text-gray-100 py-1 px-3 "
              ></textarea>
            </div>
          </div>
        </div>
        <div className="flex flex-col justify-center gap-5 py-7">
          <div className="">
            <button className="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
              Envoyer
            </button>
          </div>
          <div className="">
            <button className="text-blue-300  border-0 py-2 px-6 focus:outline-none hover:bg-gray-700 rounded text-lg">
              Retour
            </button>
          </div>
        </div>
      </div>
    </form>
  );
};

export default Form;
