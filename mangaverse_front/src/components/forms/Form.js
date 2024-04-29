import React, { useState, useRef, useEffect } from "react";

const Form = () => {

  const nameRegex = /^[a-zA-Z\- ]{2,}$/;
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const phoneRegex = /^\+(?:\d{1,3})?\d{10,14}$/;
  const sujetRegex = /^[a-zA-Z0-9\s\-,.!?:;'"()]+$/;
  const messageRegex = /^[a-zA-Z0-9\s\n\-,.!?:;'"()]+$/;


  const [firstname, setFirstname] = useState('');
  const [validFirstname, setValidFirstname] = useState(false);
  const [lastname, setLastname] = useState('');
  const [validLastname, setValidLastname] = useState(false);
  const [phone, setPhone] = useState(false);
  const [validPhone, setValidPhone] = useState('')
  const [email, setEmail] = useState('');
  const [validEmail, setValidEmail] = useState(false);
  const [sujet, setSujet] = useState(false);
  const [validSujet, setValidSujet] = useState('');
  const [msg, setMsg] = useState(false);
  const [validMsg, setValidMsg] = useState('');


  const firstnameRef = useRef(null);
  const lastnameRef = useRef(null);
  const emailRef = useRef(null);
  const phoneRef = useRef(null);
  const sujetRef = useRef(null);
  const messageRef = useRef(null);

  useEffect(() => {
    firstnameRef.current.focus();
  }, []);

  useEffect(() => {
    const result = emailRegex.test(email)
    setValidEmail(emailRegex.test(email))
  }, [email]);

  useEffect(() => {
    const result = phoneRegex.test(phone)
    setValidPhone(phoneRegex.test(phone))
  }, [phone]);

  useEffect(() => {
    const result = nameRegex.test(firstname)
    setValidFirstname(nameRegex.test(firstname))
  }, [firstname]);

  useEffect(() => {
    const result = nameRegex.test(lastname)
    setValidLastname(nameRegex.test(lastname))
  }, [lastname]);

  useEffect(() => {
    const result = sujetRegex.test(sujet)
    setValidLastname(sujetRegex.test(sujet))
  }, [sujet]);

  useEffect(() => {
    const result = msgRegex.test(msg)
    setValidLastname(msgRegex.test(msg))
  }, [msg]);


  return (
    <form>
      <div className="w-1/3 mx-auto bg-gray-700 rounded-lg ">
        <div className="flex flex-col mt items-center">
          <h2 className="text-2xl mt-5">Formulaire de contact</h2>
        </div>
        <div className="md:flex justify-center"> {/* Centering the input fields */}
          <div className="w-full p-4 flex flex-col justify-around">
            <div className="flex my-2">
              <div className="w-1/2 pr-2">
                <input
                  type="text"
                  id="name"
                  name="name"
                  placeholder="Nom"
                  className="py-3 text-center w-full bg-gray-800 rounded text-gray-100"
                />
              </div>
              <div className="w-1/2 pl-2">
                <input
                  type="text"
                  id="prenom"
                  name="prenom"
                  ref={firstnameRef}
                  placeholder="Prenom"
                  className="py-3 text-center w-full bg-gray-800 rounded text-gray-100"
                />
              </div>
            </div>
            <div className="my-2">
              <input
                type="email"
                id="email"
                name="email"
                placeholder="Email"
                className="py-3 text-center w-full bg-gray-800 rounded text-gray-100"
              />
            </div>
            <div className="my-2">
              <input
                type="tel"
                id="telephone"
                name="telephone"
                placeholder="Telephone"
                className="py-3 text-center w-full bg-gray-800 rounded text-gray-100"
              />
            </div>
            <div className="my-2">
              <input
                type="text"
                id="sujet"
                name="sujet"
                placeholder="Sujet"
                className="py-3 text-center w-full bg-gray-800 rounded text-gray-100"
              />
            </div>
            <div className="my-2">
              <textarea
                id="message"
                name="message"
                placeholder="Message"
                className="text-center w-full bg-gray-800 rounded text-gray-100 py-1 px-3"
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
            <button className="text-blue-300 border-0 py-2 px-6 focus:outline-none hover:bg-gray-700 rounded text-lg">
              Retour
            </button>
          </div>
        </div>
      </div>
    </form>
  );
};

export default Form;
